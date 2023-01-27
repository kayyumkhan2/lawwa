<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('temperature',8)->nullable();
            $table->string('Temperature_image')->nullable();
            $table->double('commission',20,2);
            $table->Integer('booking_id')->unsigned()->index();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->bigInteger('assign_user_id')->unsigned()->index();
            $table->foreign('assign_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status',['Assigned','OnTheWay','Postponed','Cancel','Start','Completed','Refunded'])->default('Assigned');
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
        Schema::dropIfExists('booking_assigns');
    }
}
