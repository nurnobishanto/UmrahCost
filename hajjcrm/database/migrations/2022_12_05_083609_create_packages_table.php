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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_info_id');
            $table->unsignedBigInteger('client_id');
            $table->string('mak_stays');
            $table->string('mad_stays');
            $table->string('total_stays');
            $table->string('flight');
            $table->string('room');
            $table->string('price');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('package_info_id')->references('id')->on('package_infos');
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
        Schema::dropIfExists('packages');
    }
};
