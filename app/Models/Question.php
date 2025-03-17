In this laravel application there is 3 type of users in User model which column name is $table->enum('role', ['admin', 'client', 'customer'])->default('customer'); Where only client can create products and customer can buy or can order products. So update below Order model as per this requirement.Some products price are free and some have price.Below is my User,Product,Order,OrderItem,ShippingAddress migration,model and there relationship.If product is free then no need to insert data to ShippingAddress model.So check below code and relation for this project.

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 50);
            $table->string('lastName', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('mobile', 50);
            $table->string('image', 255)->nullable();
            $table->enum('role', ['admin', 'client', 'customer'])->default('customer');
            $table->string('password', 255); 
            $table->boolean('accept_registration_tnc')->default(0);
            $table->string('otp', 6); 
            $table->boolean('status')->default(0);
            $table->boolean('is_email_verified')->default(0);
            $table->string('address1', 255)->nullable();
            $table->string('address2', 255)->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('county_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('doc_image1', 255)->nullable();
            $table->string('doc_image2', 255)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('county_id')->nullable()->constrained('counties')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
};

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict')->onUpdate('cascade');
            $table->string('image', 255);
            $table->string('name', 50)->unique();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('total_qty')->default(0);
            $table->string('address1', 255); 
            $table->string('address2', 255)->nullable(); 
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('county_id')->constrained('counties')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities') ->onDelete('restrict')->onUpdate('cascade');
            $table->string('zip_code', 50);
            $table->text('description'); 
            $table->date('expire_date'); 
            $table->date('collection_date'); 
            $table->time('start_collection_time'); 
            $table->time('end_collection_time'); 
            $table->decimal('latitude', 10, 8)->nullable(); 
            $table->decimal('longitude', 11, 8)->nullable(); 
            $table->boolean('accept_tnc')->default(0); 
            $table->enum('status', ['pending', 'published', 'processing', 'completed'])->default('pending'); 
            $table->timestamps();
        });
    }
};

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('color', 50);
            $table->string('size', 50);
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }
};

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); 
            $table->unsignedBigInteger('product_id');  
            $table->unsignedBigInteger('client_id');   
            $table->enum('status', ['pending', 'approved order', 'completed', 'cancel'])->default('pending');
            $table->date('order_date'); 
            $table->time('order_time'); 
            $table->boolean('accept_order_request_tnc')->default(0);
            $table->date('approve_date')->nullable(); 
            $table->time('approve_time')->nullable(); 
            $table->boolean('accept_product_delivery_tnc')->default(0);
            $table->date('delivery_date')->nullable(); 
            $table->time('delivery_time')->nullable();
            $table->date('cancel_date')->nullable(); 
            $table->time('cancel_time')->nullable(); 
            $table->unsignedDecimal('total_amount', 10, 2)->nullable();
            $table->unsignedDecimal('discount_amount', 10, 2)->default(0)->nullable(); 
            $table->unsignedDecimal('paid_amount', 10, 2)->default(0)->nullable();
            $table->string('payment_type', 50)->nullable(); 
            $table->string('payment_method', 50)->nullable(); 
            $table->string('transaction_id', 100)->nullable(); 
            $table->string('currency', 10)->nullable();  
            $table->string('order_number', 50)->nullable(); 
            $table->string('invoice_no', 50)->nullable()->unique(); 
            $table->boolean('is_free')->default(false); 
            $table->foreign('customer_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('client_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
};

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('selling_qty')->default(0); 
            $table->string('color', 50)->nullable();
            $table->string('size', 50)->nullable();
            $table->timestamps();
        });
    }
};

<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('restrict')->onUpdate('cascade');
            $table->string('name');
            $table->string('email', 50)->nullable()->unique();
            $table->string('phone');
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('zip_code', 50);
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('county_id')->constrained('counties')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict')->onUpdate('cascade'); 
            $table->timestamps();
        });
    }
};

<?php
namespace App\Models;
class User extends Authenticatable
{
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

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
  protected $fillable = ['client_id', 'category_id', 'image', 'name', 'price', 'total_qty', 'brand_id', 'address1', 'address2', 'country_id', 'county_id', 'city_id', 'zip_code', 'description', 'expire_date', 'collection_date', 'start_collection_time', 'end_collection_time', 'latitude', 'longitude', 'accept_tnc', 'status'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'color', 'size', 'qty'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'client_id', 'status', 'order_date', 'order_time',
        'accept_order_request_tnc', 'approve_date', 'approve_time','accept_product_deliver_tnc', 'delivery_date', 'delivery_time', 'cancel_date', 'cancel_time','total_amount', 'discount_amount', 'paid_amount','payment_type', 'payment_method', 'transaction_id', 'currency','order_number', 'invoice_no', 'is_free'];

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
}

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

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ShippingAddress extends Model
{
    protected $fillable = ['order_id', 'name', 'email', 'phone', 'address1', 'address2', 'zip_code', 'country_id', 'county_id', 'city_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
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
