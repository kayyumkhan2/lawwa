<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('employee_id'); 
			$table->time('start_time');
            $table->time('end_time');
			$table->date('date');
            $table->enum('type', ["group","individual"])->default("individual");
            $table->enum('current_status',['Pending','PaymentFailed','Booked','Assigned','Accepted','OnTheWay','Postponed','Cancel','Reached','Start','Completed','Refunded','Temperature uploaded','Scanned'])->default('Pending');
            $table->double('amount',20,2);
            $table->string('note',500)->nullable();
            $table->string('location',500);
            $table->enum('booking_at',["home","salon"])->default("home");
            $table->string('txn_id',100);
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
        Schema::dropIfExists('bookings');
    }
}
