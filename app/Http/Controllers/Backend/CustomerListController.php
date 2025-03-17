<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Notifications\CustomerAccountActivationNotification;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Complain;
use App\Models\CustomerComplain;

class CustomerListController extends Controller
{
    public function UpdateCustomerAccount(Request $request, $customer_id)
    {
        $customer = User::find($customer_id);
        if ($customer) {
            $customer->status = $request->input('status');
            $customer->save();

            if ($request->input('status') == 1) {
                $customer->notify(new CustomerAccountActivationNotification($customer));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer account has been successfully activated!',
                ], 200);
            } else {
                $customer->notify(new CustomerAccountActivationNotification($customer));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer account has been successfully deactivated!',
                ], 200);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'customer not found'
        ], 404);
    }


    public function CustomerPage()
    {
        return view('backend.pages.customer.customer-list');
    }


    public function CustomerList(Request $request)
    {
        try {
            $customers = User::where('role', 'user')
                ->with(['orders', 'complains','complainsReceived']) 
                ->withCount(['orders', 'complains','complainsReceived']) 
                ->latest() 
                ->get();

            foreach ($customers as $customer) {
                $distinctClients = $customer->orders->pluck('client_id')->unique();
                $customer->clients_count = $distinctClients->count();
            }

            return response()->json([
                'status' => 'success',
                'data' => $customers
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function CustomerDetailsPage(Request $request)
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
        
        return view('backend.pages.customer.customer-details');
    }


    public function CustomerDetailsInfo($customer_id)
    {
        try {
            $customer = User::with('country','county','city')->where('id', $customer_id)
                ->where('role', 'user')
                ->withCount(['orders', 'complains'])  
                ->first();

            if (!$customer) { 
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No customer found with this ID',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $customer
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving the customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function OrderListPageByCustomer()
    {
        return view('backend.pages.customer.order-list-by-customer');
    }


    public function OrderListByCustomer($customer_id)
    {
        try {
            $order = Order::with('user','food','food.user','complain')->where('user_id',$customer_id)->get();
            return response()->json([
                'status' => 'success',
                'data' => $order
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Order information not found',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainListPageByCustomer()
    {
        return view('backend.pages.customer.complain-list-by-customer');
    }


    public function ComplainListByCustomer($customer_id)
    {
        try {
            $complains = Complain::with(['order', 'food.user', 'user'])->where('user_id', $customer_id)->latest()->get();

            return response()->json([
                'status' => 'success',
                'data' => $complains
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complaints',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ClientListPageByCustomer()
    {
        return view('backend.pages.customer.client-list-by-customer');
    }


    public function ClientListByCustomer($customer_id)
    {
        try {
            $clientIds = Order::where('user_id', $customer_id)
                ->distinct('client_id')
                ->pluck('client_id'); 

            $clients = User::whereIn('id', $clientIds)
                ->where('role', 'client') 
                 ->withNonPendingFoodCount()
                 ->latest()
                ->get();

            $clients = $clients->map(function ($client) {
                return [
                    'id' => $client->id,
                    'firstName' => $client->firstName,
                    'lastName' => $client->lastName,
                    'email' => $client->email,
                    'mobile' => $client->mobile,
                    'image' => $client->image,
                    'created_at' => $client->created_at,
                    'non_pending_food_count' => $client->foods_count, 
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $clients
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving clients',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function CustomerComplainListPageByCustomer()
    {
        return view('backend.pages.customer.customer-complain-list-by-customer');
    }


    public function CustomerComplainListInfoByCustomer($customer_id)
    {
        try {
            $customerComplain = CustomerComplain::with('client','customer')->where('customer_id', $customer_id)->get(); 
            return response()->json([
                'status' => 'success',
                'data' => $customerComplain
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving customer complaints',
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
            $customer_id = $request->input('customer_id');  
            $customer = User::where('role', 'user')->findOrFail($customer_id); 

            DB::beginTransaction();

            foreach ($customer->orders as $order) {
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
            }


            if ($customer->complainsReceived->isNotEmpty()) {
                foreach ($customer->complainsReceived as $complain) {
                    if ($complain->customerComplainConversations->isNotEmpty()) {
                        foreach ($complain->customerComplainConversations as $conversation) {
                            if (!empty($conversation->reply_message)) {
                                $this->deleteImagesFromHTML($conversation->reply_message);
                            }
                            $conversation->delete();
                        }
                    }

                    if (!empty($complain->message)) {
                        $this->deleteImagesFromHTML($complain->message);
                    }

                    $complain->delete();
                }
            }
            

            if ($customer->bannedCustomers->isNotEmpty()) {
                foreach ($customer->bannedCustomers as $banRecord) {
                    if (!empty($banRecord->message)) {
                        $this->deleteImagesFromHTML($banRecord->message); 
                    }
                    $banRecord->delete();
                }
            }


            $customer_document_paths = [
                'large' => base_path('public/upload/customer-document/large/'),
                'medium' => base_path('public/upload/customer-document/medium/'),
                'small' => base_path('public/upload/customer-document/small/')
            ];

            if (!empty($customer->doc_image1)) {
                foreach ($customer_document_paths as $path) {
                    $docImage1Path = $path . $customer->doc_image1;
                    if (file_exists($docImage1Path)) {
                        unlink($docImage1Path); 
                    }
                }
            }

            if (!empty($customer->doc_image2)) {
                foreach ($customer_document_paths as $path) {
                    $docImage2Path = $path . $customer->doc_image2;
                    if (file_exists($docImage2Path)) {
                        unlink($docImage2Path); 
                    }
                }
            }


            $customer_profile_paths = [
                'large' => base_path('public/upload/user-profile/large/'),
                'medium' => base_path('public/upload/user-profile/medium/'),
                'small' => base_path('public/upload/user-profile/small/')
            ];

            if (!empty($customer->image)) {
                foreach ($customer_profile_paths as $path) {
                    $imagePath = $path . $customer->image;
                    if (file_exists($imagePath)) {
                        unlink($imagePath); 
                    }
                }
            }


            $customer->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Client, profile images, complaints, conversations, and related data deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => 'Client not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}