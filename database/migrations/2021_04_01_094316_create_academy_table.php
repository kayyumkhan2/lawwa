<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy', function (Blueprint $table) {
            $table->id();
            $table->string('section_1_heading');
            $table->text('section_1_content');
            $table->string('section_2_heading');
            $table->text('section_2_content');
            $table->string('section_3_heading');
            $table->text('section_3_content');
            $table->string('section_4_heading');
            $table->text('section_4_content');
            $table->string('section_1_image');
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
        Schema::dropIfExists('academy');
    }
}
