<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\FoodRequestNotification;
use Illuminate\Validation\ValidationException; 
use App\Helpers\ActivityLogger;
use Exception;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\County;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Complain;
use App\Models\CustomerComplain;
use App\Models\BannedCustomer;
use App\Models\ActivityLog;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:products,id',
            ]);

            $customer_id = $request->header('id');
            $product_id = $request->input('id');

            $customer = User::find($customer_id);
            if (!$customer) {
                ActivityLogger::log('new_request_failed', 'Unauthorized. Need to login.', $request, 'users');
                return response()->json([
                    'status' => 'unauthorized',
                    'message' => 'Customer not found. Need to login.',
                ], 401);
            }

            $food = Food::with('user', 'category')->find($product_id);
            if (!$food) {
                ActivityLogger::log('new_request_failed', 'Item not found.', $request, 'foods');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Product not found.',
                ], 404);
            }

            $client = $product->user;
            if (!$client || $client->role !== 'client') {
                ActivityLogger::log('new_request_failed', 'Item does not belong to this client.', $request, 'foods');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'The food does not belong to this client.',
                ], 400);
            }

            if ($customer->status == 0) {
                ActivityLogger::log('new_request_failed', 'To request an item, you must submit the necessary documents.', $request, 'users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'To request an item, you must submit the necessary documents.',
                    'document_url' => '/user/document',
                ], 403);
            }

            $isBanned = BannedCustomer::where('client_id', $client->id)
            ->where('customer_id', $customer_id)
            ->exists();

            if ($isBanned) {
                ActivityLogger::log('new_request_failed', "You are banned by {$client->firstName}. You cannot request any item from this client.", $request, 'banned_customers');
                return response()->json([
                    'status' => 'failed',
                    'message' => "You are banned by {$client->firstName}. You cannot request any item from this client.",
                ], 403);
            }

            $hasUnresolvedComplaint = CustomerComplain::where('customer_id', $customer_id)
            ->where('status', '!=', 'solved')
            ->exists();

            if ($hasUnresolvedComplaint) {
                ActivityLogger::log('new_request_failed', 'There is a complaint against you. You cannot request until the complaint is resolved.', $request, 'customer_complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'There is a complaint against you. You cannot request until the complaint is resolved.',
                ], 403);
            }

            $currentDateTime = Carbon::now();
            //$order_date = $currentDateTime->format('d F Y');
            $order_date = $currentDateTime->format('Y-m-d');
            $order_time = $currentDateTime->format('h:i:s A');

            $existingOrder = Order::where('user_id', $customer_id)
            ->where('client_id', $client->id)
            ->where('order_date', $order_date)
            ->exists();

            if ($existingOrder) {
                ActivityLogger::log('new_request_failed', 'You can only place one order per client per day.','orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You can only place one order per client per day.',
                ], 400);
            }

            $dailyOrderCount = Order::where('user_id', $customer_id)
            ->where('order_date', $order_date)
            ->count();

            $maxRequest = $food->category->max_request_by_customer ?? 3;
            if ($dailyOrderCount >= $maxRequest) {
                ActivityLogger::log('new_request_failed', 'You have reached the maximum number of daily orders.', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You have reached the maximum number of daily orders.',
                ], 400);
            }

            $order = Order::create([
                'user_id' => $customer_id,
                'food_id' => $food_id,
                'client_id' => $client->id,
                'order_date' => $order_date,
                'order_time' => $order_time,
            ]);

            if ($order) {
                ActivityLogger::log('new_request_success', 'Customer request an item is successful.', $request, 'orders');

                $food->update(['status' => 'processing']);
                $client->notify(new FoodRequestNotification($order));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Item request accepted successfully.',
                    'data' => $order,
                ], 201);
            } else {
                ActivityLogger::log('new_request_failed', 'Failed to create order.', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create order.',
                ], 500);
            }
        } catch (ValidationException $e) {
            ActivityLogger::log('new_request_failed', 'Validation failed. ' . json_encode($e->errors()), $request, 'users');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('new_request_failed', 'Item request failed. ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Item request failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function OrderPage()
    {
        return view('frontend.pages.order.order-page');
    }

    public function OrderList(Request $request)
    {
        try {
            $id = $request->header('id');
            $order = Order::with('user','food','food.user','complain')->where('user_id',$id)->get();
            ActivityLogger::log('retrieve_order_success', 'Orders retrieved successfully.', $request, 'orders');


            return response()->json([
                'status' => 'success',
                'data' => $order
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log('retrieve_order_failed', 'System error: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Order information not found',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function OrderDetailsPage(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();

        $notification_id = $request->query('notification_id');
        
        if ($notification_id) {
            $notification = $user->notifications()->where('id', $notification_id)->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();

                // Check if this notification is a reminder and mark the original as read
                $originalNotificationId = $notification->data['original_notification_id'] ?? null;
                if ($originalNotificationId) {
                    $originalNotification = $user->notifications()->where('id', $originalNotificationId)->first();
                    if ($originalNotification && is_null($originalNotification->read_at)) {
                        $originalNotification->markAsRead();
                    }
                }
            }
        }

        return view('frontend.pages.order.order-details-page');
    }

    public function OldOrderDetailsPage(Request $request)
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

        return view('frontend.pages.order.order-details-page');
    }


    public function OrderDetailsInfo(Request $request, $order_id)
    {
        try {
            $order = Order::with('user', 'food', 'food.foodImages', 'food.user')
            ->findOrFail($order_id);

            $user_id = $request->header('id');
            $user = User::findOrFail($user_id);

            ActivityLogger::log('view_order_details_success', 'Order details accessed successfully.', $request, 'orders');

            if ($user) {
                $notification = $user->notifications()
                ->where('notifiable_id', $user_id)
                ->where('data->order_id', $order_id)  
                ->first();

                if ($notification && is_null($notification->read_at)) {
                    $notification->markAsRead();
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $order,
            ], 200);

        } catch (ModelNotFoundException $e) {
            ActivityLogger::log('view_order_details_failed', 'Order or user not found: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 404);

        } catch (Exception $e) {
            ActivityLogger::log('view_order_details_failed', 'Error while retrieving order details: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Order information not found',
                'error' => $e->getMessage()
            ], 500); 
        }
    }
}


