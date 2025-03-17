<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Complain;

class ClientDashboardController extends Controller
{
    public function DashboardPage()
    {
        return view('client.pages.dashboard.dashboard-page');
    }

    public function TotalInfo(Request $request)
    {
        try {
            $clientId = $request->header('id');

            $totalProducts = Product::where('client_id', $clientId)->count();

            $totalOrders = Order::where('client_id', $clientId)->count();

            $totalCustomers = Order::where('client_id', $clientId)
                ->distinct('customer_id') 
                ->count('customer_id');

            $totalComplaints = Complain::whereHas('order', function ($query) use ($clientId) {
                $query->where('client_id', $clientId);
            })->count();

            return response()->json([
                'status' => 'success',
                'totalCustomers' => $totalCustomers,
                'totalProducts' => $totalProducts,
                'totalOrders' => $totalOrders,
                'totalComplaints' => $totalComplaints,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving totals',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function Logout()
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ], 200)->withCookie(cookie()->forget('token'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while logging out',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
