<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',500)->unique();
            $table->string('product_thumbnail',25);
            $table->integer('unit')->nullable();
            $table->string('unit_type',30)->nullable();
            $table->decimal('price',20,2);
            $table->decimal('sale_price',20,2);
            $table->decimal('member_price',20,2);
            $table->smallInteger('stock')->default(0);
            $table->enum('product_type',['Simple','Variable'])->default('Simple');
            $table->mediumText('description')->nullable();
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
