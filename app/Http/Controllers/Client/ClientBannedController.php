<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Notifications\BannedCustomerNotification;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Order;
use App\Models\BannedCustomer;
use Carbon\Carbon;

class ClientBannedController extends Controller
{
    public function uploadEditorImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(100, 100)->save(public_path('upload/banned_customer_images/client/' . $imageName));
            $url = asset('upload/banned_customer_images/client/' . $imageName);
            return response()->json(['image_url' => $url], 200);
        }
    }


    public function deleteEditorImage(Request $request)
    {
        $imageUrl = $request->input('image_url');

        $imagePath = parse_url($imageUrl, PHP_URL_PATH);

        $fullImagePath = public_path($imagePath);

        if (File::exists($fullImagePath)) {
            File::delete($fullImagePath);
            return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Image not found'], 404);
    }


    public function StoreBannedCustomerInfo(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string|min:20',
                'customer_id' => 'required|exists:users,id',
            ]);

            $client_id = $request->header('id');

            $existingCustomer = BannedCustomer::where('client_id', $client_id)
            ->where('customer_id', $validated['customer_id'])
            ->first();

            if ($existingCustomer) {
                ActivityLogger::log('banned_customer_failed', 'You have already banned this customer.', $request, 'banned_customers');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You have already banned this customer.',
                ], 403);
            }

            $currentDateTime = Carbon::now();

            $bannedCustomer = BannedCustomer::create([
                'client_id' => $client_id,
                'customer_id' => $validated['customer_id'],
                'message' => $validated['message'],
            ]);

            if ($bannedCustomer) {
                $customer = User::find($validated['customer_id']);
                if ($customer) {
                    $pendingOrders = Order::where('user_id', $customer->id)
                    ->whereNotIn('status', ['cancel', 'completed'])
                    ->get();

                    foreach ($pendingOrders as $order) {
                        $order->update([
                            'status' => 'cancel',
                            'cancel_date' => $currentDateTime->format('Y-m-d'),
                            'cancel_time' => $currentDateTime->format('H:i:s'),
                        ]);

                        $food = $order->food;
                        if ($food) {
                            $food->update([
                                'status' => 'published',
                            ]);
                        }
                    }

                    $customer->notify(new BannedCustomerNotification($bannedCustomer));
                }

                $admin = User::where('role', 'admin')->first();
                if ($admin) {
                    $admin->notify(new BannedCustomerNotification($bannedCustomer));
                }

                ActivityLogger::log('banned_customer_success', 'Customer has been banned successfully.', $request, 'banned_customers');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer has been banned successfully, and their pending orders have been canceled.',
                    'data' => $bannedCustomer,
                ], 201);
            } else {
                ActivityLogger::log('banned_customer_failed', 'Failed to ban the customer.', $request, 'banned_customers');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to ban the customer.',
                ], 500);
            }
        } catch (ValidationException $e) {
            ActivityLogger::log('banned_customer_failed', 'Validation failed: ' . implode(', ', $e->errors()), $request, 'banned_customers');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('banned_customer_failed', 'An unexpected error occurred: ' . $e->getMessage(), $request, 'banned_customers');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function BanCustomerPage()
    {
        return view('client.pages.banned-customer.banned-customer-list-page');
    }

    public function BanCustomerList(Request $request)
    {
        try {
            $client_id = $request->header('id');

            $bannedCustomers = BannedCustomer::with('customer')->where('client_id', $client_id)->latest()->get();
            ActivityLogger::log('retrieve_banned_success', 'Successfully retrieved the banned customer list.', $request, 'banned_customers');
            return response()->json([
                'status' => 'success',
                'data' => $bannedCustomers
            ], 200); 

        } catch (Exception $e) {
            ActivityLogger::log('retrieve_banned_failed', 'An unexpected error occurred: ' . $e->getMessage(), $request, 'banned_customers');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complaints',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function deleteImagesFromHTML($htmlContent)
    {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $htmlContent, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $imageUrl) {
                $imagePath = ltrim(parse_url($imageUrl, PHP_URL_PATH), '/');
                $fullImagePath = public_path($imagePath);
                if (File::exists($fullImagePath)) {
                    File::delete($fullImagePath);
                }
            }
        }
    }


    public function delete(Request $request)
    {
        try {
            $client_id = $request->header('id');
            $ban_id = $request->input('id');
            $banCustomer = BannedCustomer::where('id',$ban_id)->where('client_id', $client_id)->first();

            if (!empty($banCustomer->message)) {
                $this->deleteImagesFromHTML($banCustomer->message); 
            }
            $banCustomer->delete();
            ActivityLogger::log(
                'delete_banned_success',
                'Customer removed from the ban list successfully.',
                $request,
                'banned_customers'
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Customer remove from ban list successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            ActivityLogger::log(
                'delete_banned_failed',
                'Customer not found.',
                $request,
                'banned_customers'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            ActivityLogger::log(
                'delete_banned_failed',
                'An unexpected error occurred: ' . $e->getMessage(),
                $request,
                'banned_customers'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}