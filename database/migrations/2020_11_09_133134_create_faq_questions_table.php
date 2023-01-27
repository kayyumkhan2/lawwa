<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->id();
            $table->mediumtext('question');
            $table->text('answer');
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('faq_questions');
    }
}
