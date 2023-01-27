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
            $table->string('heading',500);
            $table->string('image',250);
            $table->text('content');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('gallery_news');
    }
}
