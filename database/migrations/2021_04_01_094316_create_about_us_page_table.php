<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us_page', function (Blueprint $table) {
            $table->id();
            $table->string('section_1_heading');
            $table->text('section_1_content');
            $table->string('section_1_image');
            
            $table->string('section_2_heading');
            $table->text('section_2_content');
            $table->string('section_2_image_1');
            $table->string('section_2_image_2');
            $table->string('section_2_image_3');
            $table->string('section_2_image_4');
            
            $table->string('section_3_heading');
            $table->text('section_3_content');
            $table->string('section_3_image'); 

            $table->string('section_4_heading');
            $table->text('section_4_content');
            $table->string('section_4_image');

            $table->string('section_5_heading');
            $table->text('section_5_content');
            $table->string('section_5_image');

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
        Schema::dropIfExists('home_page_contents');
    }
}
