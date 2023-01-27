<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();
            $table->text('about_us_text')->nullable();
            $table->text('membership_text')->nullable();
            $table->text('contact_us_text',30);
            $table->string('about_us_image',500);
            $table->string('about_us_video',500);
            $table->enum('status', [0,1])->default(1)->comment('0 inactive 1 Active');
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
