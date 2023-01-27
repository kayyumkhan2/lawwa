<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
			$table->string('product_name',500);
			$table->string('product_image');
            $table->decimal('product_price',20,2);
			$table->tinyInteger('product_quantity');
			$table->BigInteger('product_id');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('unit')->nullable();
            $table->Integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('booking_services');
    }
}
