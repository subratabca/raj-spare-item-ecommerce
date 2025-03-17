<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = ['order_id','product_id','customer_id','message','status','cmp_date','cmp_time','clnt_cmp_date','clnt_cmp_time','clnt_cmp_feedback_date','clnt_cmp_feedback_time'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function conversations()
    {
        return $this->hasMany(ComplainConversation::class);
    }
}
