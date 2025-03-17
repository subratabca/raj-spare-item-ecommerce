<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_variant_id', 'selling_qty', 'color', 'size'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
