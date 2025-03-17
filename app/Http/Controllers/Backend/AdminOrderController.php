<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;
use Carbon\Carbon;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\User;
use App\Models\Complain;

class AdminOrderController extends Controller
{
    public function OrderPage()
    {
        return view('backend.pages.order.order-list');
    }

    public function OrderList(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $orders = Order::with('user', 'food')->latest()->get();

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
        if ($notification_id) {
            $notification = $user->notifications()->where('id', $notification_id)->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

        return view('backend.pages.order.order-details');
    }


    public function OrderDetails($order_id)
    {
        try {
            $order = Order::with('user','food','food.user','food.foodImages')->findOrFail($order_id);
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
            $order_id = $request->input('order_id');
            $order = Order::findOrFail($order_id); 

            DB::beginTransaction(); 

            if ($order->complain) {
                if (!empty($order->complain->message)) {
                    $this->deleteImagesFromHTML($order->complain->message);
                }

                foreach ($order->complain->conversations as $conversation) {
                    if (!empty($conversation->reply_message)) {
                        $this->deleteImagesFromHTML($conversation->reply_message);
                    }
                    $conversation->delete(); 
                }

                $order->complain->delete(); 
            }

            if ($order->food && $order->food->status != 'published') {
                $order->food->update(['status' => 'published']);
            }

            $order->delete();
            ActivityLogger::log(
                'order_delete_success',
                'Order, related complaints, conversations, and associated data deleted successfully.',
                $request,
                'orders'
            );

            DB::commit(); 
            return response()->json([
                'status' => 'success',
                'message' => 'Order, related complaints, conversations, and associated data deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            DB::rollBack(); 

            ActivityLogger::log(
                'order_delete_failed',
                'Order not found.',
                $request,
                'orders'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            DB::rollBack();

             ActivityLogger::log(
                'order_delete_failed',
                'An error occurred while deleting the order: ' . $e->getMessage(),
                $request,
                'orders'
            ); 
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}