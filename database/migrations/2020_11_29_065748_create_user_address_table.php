<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('MobileNumber',20)->nullable();;
            $table->string('Country',100)->nullable();
            $table->string('State_Province_Region',100)->nullable();
            $table->string('Town_City',100);
            $table->bigInteger('Zip_Postcode')->nullable();
            $table->string('Type',30);
            $table->string('Address_line1',250)->nullable()->nullable();
            $table->string('Address_line2',250)->nullable()->nullable();
            $table->string('Longitude')->nullable();
            $table->bigInteger('Latitude')->nullable();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('driver_informations');
    }
}
