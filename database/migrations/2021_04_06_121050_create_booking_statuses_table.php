<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->Integer('booking_id')->unsigned()->index();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->enum('status',['Pending','PaymentFailed','Booked','Assigned','Accepted','OnTheWay','Postponed','Cancel','Reached','Start','Completed','Refunded','Temperature uploaded','Scanned'])->default('Pending');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('booking_statuses');
    }
}
