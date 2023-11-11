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
     * 
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_id_generate')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alter_mobile')->nullable();
            $table->string('pin')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('house_no')->nullable();
            $table->string('road_name')->nullable();
            $table->string('landmark')->nullable();
            $table->string('address_type')->nullable(); 
            $table->string('amount')->nullable(); 
            $table->string('discount')->nullable(); 
            $table->string('gst')->nullable(); 
            $table->string('net_amount')->nullable(); 
            $table->string('payment_method')->nullable(); 
            $table->string('payment_gateway_id')->nullable(); 
            $table->enum('booking_type', ['COD', 'Online'])->nullable(); 
            $table->enum('order_status', ['Success', 'Failer'])->nullable(); 
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * 
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
