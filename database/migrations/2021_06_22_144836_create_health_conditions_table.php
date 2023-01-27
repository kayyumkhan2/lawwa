<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('Name',300);
            $table->string('Name_type',10);
            $table->string('Address',500);
            $table->string('H_p_no',20);
            $table->date('Dob');
            $table->enum('Marital_status',['Married','Single','Others']);
            $table->string('Occupation',300);
            $table->bigInteger('Emergency_number');
            $table->enum('Plastic_Surgery_Face',['Yes','No']);
            $table->date('Plastic_Surgery_Date_Face')->nullable();
            $table->string('Plastic_Surgery_Type_Face')->nullable();
            $table->enum('Plastic_Surgery_Body',['Yes','No']);
            $table->date('Plastic_Surgery_Date_Body')->nullable();
            $table->string('Plastic_Surgery_Type_Body')->nullable();
            $table->enum('Pregnant',['Yes','No'])->default('No');
            $table->string('Pregnancy_Month')->nullable();
            $table->enum('Medications',['Yes','No']);
            $table->string('Medications_Specify',300)->nullable();
            $table->enum('Skin_Allergy',['Yes','No']);
            $table->string('Skin_Allergy_Specify',300)->nullable();
            $table->string('Skin_Type_Specify',300)->nullable();
            $table->string('Service_Focus');
            $table->string('Service_Focus_Remark',300)->nullable();
            $table->enum('Last_Facial_Treatment',['Yes','No']);
            $table->date('Last_Facial_Treatment_date')->nullable();
            $table->string('Last_Facial_Treatment_Type')->nullable();
            $table->string('Last_Facial_Treatment_How_Often')->nullable();
            $table->string('Skincare_Routine_At_Home');
            $table->string('Skincare_Routine_At_Specify')->nullable();
            $table->string('Product_Brand_Use')->nullable();
            $table->enum('Last_Body_Treatment',['Yes','No']);
            $table->date('Last_Body_Treatment_Date')->nullable();
            $table->string('Last_Body_Treatment_Type')->nullable();
            $table->string('Last_Body_Treatment_How_Often')->nullable();
            $table->enum('Body_Allergy_Sensitive',['Yes','No']);
            $table->string('Body_Allergy_Sensitive_Specify',300)->nullable();
            $table->enum('Joint_Condition',['Yes','No']);
            $table->string('Joint_Condition_Specify',300)->nullable();
            $table->enum('Bone_Condition',['Yes','No']);
            $table->string('Bone_Condition_Specify',300)->nullable();
            $table->enum('Circulatory_Condition',['Yes','No']);
            $table->string('Circulatory_Condition_Specify',300)->nullable();
            $table->enum('Diabetes',['Yes','No']);
            $table->string('Diabetes_Specify',300)->nullable();
            $table->string('Customer_Sign',300);
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
        Schema::dropIfExists('health_conditions');
    }
}
