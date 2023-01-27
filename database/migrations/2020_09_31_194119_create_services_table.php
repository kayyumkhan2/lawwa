<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('name');
            $table->string('service_image');
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
            $table->decimal('amount',20,2);
            $table->mediumText('brief_detail');
            $table->string('point')->nullable();
            $table->string('houre')->nullable();
            $table->string('minute')->nullable();
            $table->bigInteger('UserId')->unsigned()->index();
            $table->foreign('UserId')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
