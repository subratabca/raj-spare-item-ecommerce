<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['firstName','lastName','email','mobile','image','role','password','accept_registration_tnc','otp','status','is_email_verified','address1','address2','zip_code','country_id','county_id','city_id','doc_image1','doc_image2','latitude','longitude'];
    
    protected $attributes = ['otp' => '0'];

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'client_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function ordersBasedOnRole()
    {
        return $this->hasMany(Order::class, 'client_id')->where('role', 'client')
            ->orWhere('user_id', $this->id)->where('role', 'user');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'client_id');
    }

    public function customerComplains() {
        return $this->hasMany(CustomerComplain::class, 'customer_id');
    }

    public function bannedCustomers()
    {
        return $this->hasMany(BannedCustomer::class, 'customer_id');
    }

    public function bannedByClients()
    {
        return $this->hasMany(BannedCustomer::class, 'client_id');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'client_id');
    }

    // public function following()
    // {
    //     return $this->hasMany(Follower::class, 'customer_id');
    // }

    public function productShares()
    {
        return $this->hasMany(ProductShare::class, 'customer_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}


