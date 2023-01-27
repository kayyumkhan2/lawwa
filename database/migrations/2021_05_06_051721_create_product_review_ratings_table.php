<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('product_review_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('rating');
            $table->string('comment',500)->nullable();
            $table->string('title',250)->nullable();
            $table->Integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->nullable()->default(0)->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->index();
            $table->foreign('product_id')->nullable()->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->boolean('approved')->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_review_ratings');
    }
}
