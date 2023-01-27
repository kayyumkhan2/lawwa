<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_users', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',10,2)->default(0);
            $table->string('txn_id',100);
            $table->string('certificate_name');
            $table->enum('payment_status',['PENDING','PAYMENTFAILED','SUCCESS'])->default('PENDING');
            $table->enum('status',['PENDING','UPLOADED','FAILED'])->default('PENDING');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('certificate_id')->unsigned()->index();
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
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
        Schema::dropIfExists('certificate_users');
    }
}
