<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; 
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Food;
use App\Models\Complain;

class DashboardController extends Controller
{
    public function DashboardPage()
    {
        return view('frontend.pages.dashboard.dashboard-page');
    }


    public function TotalInfo(Request $request)
    {
        try {
            $userId = $request->header('id');

            $totalOrders = Order::where('user_id', $userId)->count();

            $totalComplaints = Complain::whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->count();

            return response()->json([
                'status' => 'success',
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