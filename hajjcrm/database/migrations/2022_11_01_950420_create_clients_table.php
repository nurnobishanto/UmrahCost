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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('groupName')->nullable();
            $table->string('groupNo')->nullable();
            $table->string('givenName');
            $table->string('surName')->nullable();
            $table->string('passportNo')->nullable();
            $table->string('passportType')->nullable();
            $table->string('issuingCountry')->nullable();
            $table->string('ppIssueDate')->nullable();
            $table->string('ppExpiryDate')->nullable();
            $table->string('dateofBirth')->nullable();
            $table->string('Mobile');
            $table->string('emergencyMobile')->nullable();
            $table->string('email');
            $table->string('nosofPerson');
            $table->string('tourMonth');
            $table->string('status')->nullable();
            $table->text('queryDetails');
            $table->text('note');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('crm_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('source_id')->references('id')->on('sources');
            $table->foreign('crm_id')->references('id')->on('crms');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('clients');
    }
};
