<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberShipServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_ship_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('membership_plan_id')->unsigned()->index();
            $table->bigInteger('service_id')->unsigned()->index();
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('member_ship_services');
    }
}
