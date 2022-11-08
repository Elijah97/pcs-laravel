<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serv_no')->nullable();
            $table->string('rank')->nullable();
            $table->string('names');
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('function')->nullable();
            $table->string('unit')->nullable();
            $table->integer('type')->comment('0: Head DRD, 1: Superior, 2: Applicant, 99: System Admin');
            $table->string('department')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->comment('0: Pending, 1: Active, 2: Revoked');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
