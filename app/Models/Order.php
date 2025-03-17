<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'client_id', 'status', 'order_date', 'order_time',
        'accept_order_request_tnc', 'approve_date', 'approve_time','accept_product_delivery_tnc', 'delivery_date', 'delivery_time', 'cancel_date', 'cancel_time','total_amount', 'discount_amount', 'paid_amount','payment_type', 'payment_method', 'transaction_id', 'currency','order_number', 'invoice_no', 'is_free'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function complain()
    {
        return $this->hasOne(Complain::class);
    }

}
