<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipHasFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_has_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('membership_feature_id')->unsigned()->index();
            $table->foreign('membership_feature_id')->references('id')->on('membership_features')->onDelete('cascade');
            $table->bigInteger('membership_plan_id')->unsigned()->index();
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('cascade');
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
        Schema::dropIfExists('membership_has_features');
    }
}
