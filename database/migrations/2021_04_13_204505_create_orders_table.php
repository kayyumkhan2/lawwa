<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name',150);
            $table->decimal('total_price',10,2);
            $table->tinyInteger('total_quantity');
            $table->string('txn_id',100);
            $table->string('shipping_option',100);
            $table->decimal('ShippingCharges',10,2);
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->mediumText('address',500);
            $table->enum('current_status',['PENDING','PAYMENTFAILED','ORDERED','DISPATCH','ONTHEWAY','DELIVERED','CANCEL','REFUNDED'])->default('PENDING');
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
        Schema::dropIfExists('orders');
    }
}
