<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {

            $table->id();
            $table->string('title')->nullable();
            $table->string('subject',500)->nullable();
            $table->longtext('html_template');
            $table->longtext('text_template')->nullable();
            $table->string('for')->nullable();
            $table->string('template_for')->nullable();
            $table->enum('status', [0,1])->default(1)->comment('0 deactive 1 Active');
            $table->enum('default_status', [0,1])->default(0)->comment('1 Default 0 Not Default ');
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
        Schema::dropIfExists('mail__templates');
    }
}
