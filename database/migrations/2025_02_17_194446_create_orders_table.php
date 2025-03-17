<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
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
            $table->decimal('total_amount', 10, 2)->nullable(); 
            $table->decimal('discount_amount', 10, 2)->default(0)->nullable();
            $table->decimal('paid_amount', 10, 2)->default(0)->nullable();
            $table->string('payment_type', 50)->nullable(); 
            $table->string('payment_method', 50)->nullable(); 
            $table->string('transaction_id', 100)->nullable(); 
            $table->string('currency', 10)->nullable();  
            $table->string('order_number', 50)->unique()->nullable(); 
            $table->string('invoice_no', 50)->unique()->nullable();  
            $table->boolean('is_free')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

