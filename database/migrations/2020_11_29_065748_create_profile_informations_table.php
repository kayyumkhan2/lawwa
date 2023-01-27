<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_informations', function (Blueprint $table) {
            $table->id();
            $table->date('Dob',10);
            $table->string('Gender',50)->nullable();
            $table->string('About_us',500)->nullable();
            $table->string('Photo',100)->nullable();
            $table->string('Id_Proof',100)->nullable();
            $table->string('Nric',20)->nullable();
            $table->string('Emergency_Number',15)->nullable();
            $table->bigInteger('User_id')->unsigned()->index();
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
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
