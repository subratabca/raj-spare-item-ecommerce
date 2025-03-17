<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ApproveFoodRequestNotification;
use App\Notifications\FoodDeliveryNotification;
use Illuminate\Support\Facades\Notification;
use Exception;
use Carbon\Carbon;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\Food;
use App\Models\User;

class ClientOrderController extends Controller
{
    public function OrderPage(){
        return view('client.pages.order.order-list');
    }

    public function OrderList(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $orders = Order::whereHas('food', function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->with('user', 'food')
            ->latest()
            ->get();

            ActivityLogger::log('retrieve_order_success', 'Orders retrieved successfully.', $request, 'orders');
            return response()->json([
                'status' => 'success',
                'data' => $orders
            ], 200); 

        } catch (Exception $e) {
            ActivityLogger::log('retrieve_order_failed', 'System error: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function OrderDetailsPage(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();

        $notification_id = $request->query('notification_id');
        // if ($notification_id) {
        //     $notification = $user->notifications()->where('id', $notification_id)->first();

        //     if ($notification && is_null($notification->read_at)) {
        //         $notification->markAsRead();
        //     }
        // }

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

        return view('client.pages.order.order-details');
    }
    
    public function OrderDetails(Request $request, $id)
    {
        try {
            $order = Order::with('user','food','food.user','food.foodImages')->findOrFail($id);
            ActivityLogger::log('view_order_details_success', 'Order details accessed successfully.', $request, 'orders');
            return response()->json([
                'status' => 'success',
                'data' => $order
            ], 200);
        } catch (Exception $e) {
            ActivityLogger::log('view_order_details_failed', 'Error while retrieving order details: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Order information not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }


    public function ApproveFoodRequest(Request $request)
    {
        try {
            $accept_tnc = $request->input('accept_tnc');
            $order_id = $request->input('id');
            $order = Order::with('user','food')->where('id', $order_id)->first();

            $currentDateTime = Carbon::now();
            $approve_date = $currentDateTime->format('d F Y');
            $approve_time = $currentDateTime->format('h:i:s A');

            $order->update([
                'status' => 'approved food request',
                'accept_order_request_tnc' => $request->input('accept_tnc'),
                'approve_date' => $approve_date,
                'approve_time' => $approve_time
            ]);

            $food = $order->food;
            if ($order->user->role === 'user') {
                $order->user->notify(new ApproveFoodRequestNotification($food,$order));
            }

            ActivityLogger::log('request_approved_success', 'Item request approved successfully.', $request, 'orders');
            return response()->json([
                'status' => 'success',
                'message' => 'Item request approved successfully.'
            ], 200);
        } catch (ModelNotFoundException $e) {
           ActivityLogger::log('request_approved_failed', 'Order not found', $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
           ActivityLogger::log('request_approved_failed', 'An error occurred: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function DeliveredFoodRequest(Request $request)
    {
        try {
            $accept_tnc = $request->input('accept_tnc');
            $order_id = $request->input('id');
            $order = Order::with('user','food')->where('id', $order_id)->first();

            if (is_null($order)) {
                ActivityLogger::log('item_delivered_failed', 'Order not found', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order not found.',
                ], 404);
            }

            $currentDateTime = Carbon::now();
            $delivery_date = $currentDateTime->format('d F Y');
            $delivery_time = $currentDateTime->format('h:i:s A');

            $order->update([
                'status' => 'completed',
                'accept_food_deliver_tnc' => $request->input('accept_tnc'),
                'delivery_date' => $delivery_date,
                'delivery_time' => $delivery_time
            ]);

            $food = $order->food;
            if ($food) {
                $food->update(['status' => 'completed']);

                if ($order->user->role === 'user') {
                    $order->user->notify(new FoodDeliveryNotification($food,$order));
                }

                $admin = User::where('role', 'admin')->first();
                $admin->notify(new FoodDeliveryNotification($food,$order));

            } else {
                ActivityLogger::log('item_delivered_failed', 'Item not found.', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Food item not found.',
                ], 404);
            }

            ActivityLogger::log('item_delivered_success', 'Item delivery completed successfully.', $request, 'orders');
            return response()->json([
                'status' => 'success',
                'message' => 'Item delivery completed successfully.',
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log('item_delivered_failed', 'An error occurred: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function CancelFoodRequest(Request $request)
    {
        try {
            $order_id = $request->input('id');
            $order = Order::find($order_id);

            if (is_null($order)) {
                ActivityLogger::log('request_cancel_failed', 'Order not found', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order not found.',
                ], 404);
            }

            $currentDateTime = Carbon::now();
            $cancel_date = $currentDateTime->format('d F Y');
            $cancel_time = $currentDateTime->format('h:i:s A');

            $order->update([
                'status' => 'cancel',
                'cancel_date' => $cancel_date,
                'cancel_time' => $cancel_time
            ]);

            $food_id = $order->food_id;
            $food = Food::find($food_id);
            if ($food) {
                $food->update(['status' => 'published']);
            } else {
                ActivityLogger::log('request_cancel_failed', 'Food item not found.', $request, 'orders');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Food item not found.',
                ], 404);
            }

            ActivityLogger::log('request_cancel_success', 'Item cancelled successfully.', $request, 'orders');
            return response()->json([
                'status' => 'success',
                'message' => 'Item cancell successfully.',
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log('request_cancel_failed', 'An error occurred: ' . $e->getMessage(), $request, 'orders');
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}