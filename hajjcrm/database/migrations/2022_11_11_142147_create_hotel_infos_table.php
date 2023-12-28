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
        Schema::create('hotel_infos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('city');
            $table->string('type');
            $table->string('code');
            $table->string('distance')->default(0);
            $table->decimal('double_price', 8, 2);
            $table->decimal('triple', 8, 2);
            $table->decimal('quad', 8, 2);
            $table->string('offerd')->nullable();
            $table->string('valid')->nullable();
            $table->string('notes')->nullable();
            $table->string('googleMap')->nullable();

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
        Schema::dropIfExists('hotel_infos');
    }
};
