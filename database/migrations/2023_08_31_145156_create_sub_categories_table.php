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
        // Schema::create('sub_categories', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('category_id')->nullable();
        //     $table->string('name')->nullable();
        //     $table->string('slug')->nullable();
        //     $table->text('img')->nullable();
        //     $table->enum('status', ['Active', 'Inactive'])->nullable();
        //     $table->timestamps();
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
