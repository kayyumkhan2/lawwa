<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_history', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->decimal('ShippingCharges',10,2);
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('txn_id',100);
            $table->enum('type',['Order','Booking','Membership','Certification','Course']);
            $table->enum('status',['Failed','Successed']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('payment_history');
    }
}
