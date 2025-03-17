<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ValidationHelper;
use App\Helpers\ImageHelper;
use App\Helpers\ItemHelper;
use App\Helpers\LocationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewProductNotification;
use App\Notifications\ProductPublishNotification;
use Illuminate\Validation\ValidationException; 
use Illuminate\Support\Facades\DB;
use Exception;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductImage;


class AdminProductController extends Controller
{
    public function ProductPage()
    {
        return view('backend.pages.product.product-list');
    }

    public function index(Request $request)
    {
        try {
            $products = Product::with('productImages')->latest()->get();
            ActivityLogger::log(
                'retrieve_item_success',
                'Successfully retrieved products.',
                $request,
                'products'
            );
            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200); 

        } catch (Exception $e) {
            ActivityLogger::log(
                'retrieve_item_failed',
                'Failed to retrieve products. Error: ' . $e->getMessage(),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function CreatePage()
    {
        return view('backend.pages.product.create');
    }

    private function formatAndFetchCoordinates(Request $request)
    {
        try {
            $formattedAddress = LocationHelper::formatAddress($request);
            $geoData = LocationHelper::getCoordinatesFromAddress($formattedAddress);

            if (!$geoData) {
                ActivityLogger::log(
                    'retrieve_item_failed', 
                    'Unable to fetch coordinates for the provided address.', 
                    $request, 
                    'products'
                );
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unable to fetch coordinates for the provided address.',
                ], 422);
            }

            ActivityLogger::log(
                'retrieve_item_success', 
                'Coordinates fetched successfully.', 
                $request, 
                'products'
            );
            return $geoData;
        } catch (Exception $e) {
            ActivityLogger::log(
                'retrieve_item_failed', 
                'Error occurred while fetching coordinates: ' . $e->getMessage(), 
                $request, 
                'products'
            );

            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while fetching coordinates.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate(ValidationHelper::itemValidationRules());
            $geoData = $this->formatAndFetchCoordinates($request);

            $imagePath = $request->hasFile('image')
            ? ImageHelper::processAndSaveImage($request->file('image'), 'item')
            : null;

            $productData = ItemHelper::prepareItemData($request, $imagePath);
            $productData['latitude'] = $geoData['latitude'];
            $productData['longitude'] = $geoData['longitude'];
            $product = ItemHelper::storeOrUpdateItem($productData);

            if ($request->hasFile('multi_images') && count($request->file('multi_images')) > 0) {
                ItemHelper::saveMultiImages($request->file('multi_images'), $product->id);
            }

            ActivityLogger::log(
                'item_creation_success',
                'Product created successfully.',
                $request,
                'products'
            );
            DB::commit();

            $admin = User::where('role', 'admin')->first();
            $admin->notify(new NewProductNotification($product));

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully.',
                'data' => $product
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            ActivityLogger::log(
                'item_creation_failed',
                'Validation failed during product creation. Errors: ' . json_encode($e->errors()),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            ActivityLogger::log(
                'item_creation_failed',
                'Product creation failed due to an error. Error: ' . $e->getMessage(),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function DetailsPage(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();

        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $notification = $user->notifications()->where('id', $notification_id)->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

        return view('backend.pages.product.product-details');
    }

    public function show(Request $request,$id)
    {
        try {
            $product = Product::with('client','productImages','category','country','county','city')->find($id);

            if (!$product) {
                ActivityLogger::log(
                    'retrieve_item_failed',
                    'Product not found.',
                    $request,
                    'products'
                );
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Product not found'
                ], 404);
            }

            ActivityLogger::log(
                'retrieve_item_success',
                'Product info found successfully.',
                $request,
                'products'
            );
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log(
                'retrieve_item_failed',
                'Error occurred while retrieving item details: ' . $e->getMessage(),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function EditPage()
    {
        return view('backend.pages.product.edit');
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate(ValidationHelper::itemValidationRules(true));
            $product_id = $request->input('id');
            $product = Product::findOrFail($product_id);

            $geoData = $this->formatAndFetchCoordinates($request);

            $imagePath = $request->hasFile('image')
            ? ImageHelper::processAndSaveImage($request->file('image'), 'item', false, $product->image)
            : $product->image;

            $productData = ItemHelper::prepareItemData($request, $imagePath, true);
            $productData['latitude'] = $geoData['latitude'];
            $productData['longitude'] = $geoData['longitude'];
            $updatedProduct = ItemHelper::storeOrUpdateItem($productData, $product);

            ActivityLogger::log(
                'item_update_success',
                'Product updated successfully.',
                $request,
                'products'
            );

            DB::commit(); 
            return response()->json([
                'status' => 'success',
                'message' => 'Item updated successfully.',
                'data' => $updatedProduct
            ], 200);

        } catch (ValidationException $e) {
            DB::rollBack(); 
            ActivityLogger::log(
                'item_update_failed',
                'Validation failed: ' . json_encode($e->errors()),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack(); 
            ActivityLogger::log(
                'item_update_failed',
                'Error occurred while updating product details: ' . $e->getMessage(),
                $request,
                'products'
            );
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function EditMultiImgPage()
    {
        return view('backend.pages.product.edit-multi-img');
    }

    public function updateMultiImg(Request $request)
    {
        try {
            $request->validate([
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $id = $request->input('id');
            $productImage = ProductImage::findOrFail($id);

            if ($request->hasFile('image')) {
                ImageHelper::deleteOldImages($productImage->image, 'multi_images');
                $uploadPath = ImageHelper::processAndSaveImage($request->file('image'), 'multi_images'); 
            } else {
                $uploadPath = $productImage->image;
            }

            $productImage->update([
                'image' => $uploadPath
            ]);

            ActivityLogger::log(
                'item_multi_img_update_success',
                'Product multi image updated successfully',
                $request,
                'product_images'
            );
            return response()->json([
                'status' => 'success',
                'message' => 'product multi image updated successfully.'
            ], 200);

        } catch (ValidationException $e) {
            ActivityLogger::log(
                'item_multi_img_update_failed',
                'Validation failed: ' . json_encode($e->errors()),
                $request,
                'product_images'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log(
                'item_multi_img_update_failed',
                'Error occurred: ' . $e->getMessage(),
                $request,
                'product_images'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Product update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $product_id = $request->input('id');
        DB::beginTransaction();
        try {
            $product = Product::where('id', $product_id)->firstOrFail();

            ImageHelper::deleteOldImages($product->image, 'item');
            ImageHelper::deleteMultipleImages($product->productImages, 'multi_images');

            if ($product->order && $product->order->complain) {
                foreach ($product->order->complain->conversations as $conversation) {
                    if (!empty($conversation->reply_message)) {
                        ImageHelper::deleteImagesFromHTML($conversation->reply_message);
                    }
                    $conversation->delete();
                }

                if (!empty($product->order->complain->message)) {
                    ImageHelper::deleteImagesFromHTML($product->order->complain->message);
                }

                $product->order->complain->delete();
            }

            if ($product->order) {
                $product->order->delete();
            }

            $product->delete();

            DB::commit();

            ActivityLogger::log('item_delete_success', 'Product and its related images deleted successfully.', $request, 'products');
            return response()->json([
                'status' => 'success',
                'message' => 'Product and its related images deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            ActivityLogger::log('item_delete_failed', 'Product not found.', $request, 'products');
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            DB::rollBack();
            ActivityLogger::log('item_delete_failed', 'Error occurred during deletion: ' . $e->getMessage(), $request, 'products');
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ProductPublish(Request $request)
    {
        try {
            $product_id = $request->input('id');
            $product = Product::with('client')->findOrFail($product_id);

            $result = $product->update([
                'status' => 'published'
            ]);

            if ($product->client->role === 'client') {
                $product->client->notify(new ProductPublishNotification($product));
            }

            $customers = User::where('role', 'customer')->get();
            foreach ($customers as $customer) {
                $customer->notify(new ProductPublishNotification($product));
            }

            ActivityLogger::log('item_published_success', 'Product published successfully.', $request, 'products');
            return response()->json([
                'status' => 'success',
                'message' => 'Product published successfully and notifications sent.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            ActivityLogger::log('item_published_failed', 'Product not found.', $request, 'products');
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            ActivityLogger::log('item_published_failed', 'Error occurred during publishing: ' . $e->getMessage(), $request, 'products');
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}


