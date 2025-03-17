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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->text('message');
            $table->enum('status',['pending','under-review','solved','further-investigation'])->default('pending');
            $table->date('cmp_date')->nullable();
            $table->time('cmp_time')->nullable();
            $table->date('clnt_cmp_date')->nullable();
            $table->time('clnt_cmp_time')->nullable();
            $table->date('clnt_cmp_feedback_date')->nullable();
            $table->time('clnt_cmp_feedback_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
