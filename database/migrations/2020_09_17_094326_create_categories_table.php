<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('description',500)->nullable();
            $table->string('title',500)->nullable();
            $table->string('image');
            $table->enum('categorey_type',['0', '1','2'])->default('0')->comment('0=>Service-Categorey,1=>Product-Categorey');
            $table->enum('status',['0', '1'])->default('1')->comment('1=>active,0=>deactive');
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
        Schema::dropIfExists('categories');
    }
}
