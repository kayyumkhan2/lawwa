<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_courses', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('image',250);
            $table->string('details_page_heading',250);
            $table->double('price',20,2);
            $table->mediumText('description')->nullable();
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
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
        Schema::dropIfExists('academy_courses');
    }
}
