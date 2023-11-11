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
        // Schema::create('child_categories', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('category_id')->nullable();
        //     $table->unsignedBigInteger('sub_category_id')->nullable();
        //     $table->string('name')->nullable();
        //     $table->string('slug')->nullable();
        //     $table->text('img')->nullable();
        //     $table->enum('status', ['Active', 'Inactive'])->nullable();
        //     $table->timestamps();
        //     $table->foreign('category_id')->references('id')->on('categories');
        //     $table->foreign('sub_category_id')->references('id')->on('sub_categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_categories');
    }
};
