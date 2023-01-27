<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingUsersTable extends Migration
{
    public function up()
    {
        Schema::create('booking_users', function (Blueprint $table) {
            $table->id();
            $table->string('temperature',8)->nullable();
            $table->string('Temperature_image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->Integer('booking_id')->unsigned()->index();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('booking_users');
    }
}
