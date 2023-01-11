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
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('applicantId');
            $table->integer('categoryId');
            $table->string('reason');
            $table->string('qty')->nullable();
            $table->string('unitPrice')->nullable();
            $table->string('totalPrice')->nullable();
            $table->string('reviewStatus')->comment('0: Pending, 1: Reviewed, 2: Revoked');
            $table->integer('reviewerId')->nullable();
            $table->string('approveStatus')->comment('0: Pending, 1: Approved, 2: Revoked');
            $table->integer('approverId')->nullable();
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
        Schema::dropIfExists('applications');
    }
};
