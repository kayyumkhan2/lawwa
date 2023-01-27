<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rating');
            $table->string('comment',500)->nullable();
            $table->bigInteger('sender_id')->unsigned()->index();
            $table->bigInteger('receiver_id')->unsigned()->index();
            $table->Integer('booking_id')->unsigned()->index();
            $table->foreign('booking_id')->nullable()->default(0)->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('approved')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ratings');
    }
}
