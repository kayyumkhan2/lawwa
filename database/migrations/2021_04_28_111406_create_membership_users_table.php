<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_users', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',10,2)->default(0);
            $table->string('txn_id',100);
            $table->string('membership_plan_name');
            $table->enum('payment_status',['PENDING','PAYMENTFAILED','SUCCESS'])->default('PENDING');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('membership_users');
    }
}
