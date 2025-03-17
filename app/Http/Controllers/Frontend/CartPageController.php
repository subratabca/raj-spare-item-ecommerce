<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;

class CartPageController extends Controller
{
    public function myCart()
    {
        return view('frontend.pages.cart.cart-page');
    }

    public function GetCartProduct()
    {
        try {
            $carts = Cart::with(['product', 'productVariant'])
                ->where('customer_id', Auth::id())
                ->get();

            // Calculate totals
            $cartQty = $carts->sum('quantity');
            $cartTotal = $carts->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            return response()->json([
                'success' => true,
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round($cartTotal, 2)
            ]);

        } catch (\Exception $e) {
            Log::error('Cart Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve cart items',
                'message' => 'An error occurred while loading your cart',
                'carts' => [],
                'cartQty' => 0,
                'cartTotal' => 0.00
            ], 500);
        }
    }

    public function RemoveCartProduct($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
           Session::forget('coupon');
        }
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
        return response()->json('increment');
    }

    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
        return response()->json('Decrement');
    }
}
