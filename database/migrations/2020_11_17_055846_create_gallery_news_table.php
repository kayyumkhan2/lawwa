<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryNewsTable extends Migration
{
   
    public function up()
    {
        Schema::create('gallery_news', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('heading',500);
            $table->string('image',250);
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
            $table->text('content');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('gallery_news');
    }
}
