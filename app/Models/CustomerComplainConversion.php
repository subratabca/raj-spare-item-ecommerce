<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerComplainConversion extends Model
{
    protected $fillable = ['customer_complain_id','sender_id','reply_message','sender_role'];

    public function customerComplain()
    {
        return $this->belongsTo(CustomerComplain::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
