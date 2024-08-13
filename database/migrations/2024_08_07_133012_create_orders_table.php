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
            $table->bigInteger('order_id');
            $table->string('status');
            $table->string('currency');
            $table->string('date_created');
            $table->string('date_modified');
            $table->decimal('discount_total', 10, 2)->nullable();
            $table->decimal('shipping_total', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('order_key')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_title')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('customer_note')->nullable();
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
