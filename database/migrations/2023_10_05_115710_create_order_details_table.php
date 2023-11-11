<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('order_details_id_generate')->nullable();
            $table->string('name')->nullable();
            $table->string('list_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('extra_discount')->nullable();
            $table->string('special_price')->nullable();
            $table->string('shipping_fee')->nullable();
            $table->string('total_amount')->nullable();
            $table->enum('status', ['Pending', 'Processing', 'Shipped', 'In Transit', 'Out for Delivery', 'Delivered', 'Cancelled', 'On Hold', 'Returned', 'Refunded', 'Backordered', 'Partially Shipped'])->nullable();  
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('seller_id')->references('id')->on('products');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
