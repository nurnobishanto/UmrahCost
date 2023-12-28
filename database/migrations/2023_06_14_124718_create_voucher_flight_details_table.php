<?php

use App\Models\ServiceVoucher;
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
        Schema::create('voucher_flight_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceVoucher::class)->nullable();                      
            $table->date('date')->nullable(); 
            $table->string('career')->nullable(); 
            $table->string('flight_no')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('etd')->nullable()->comment('Estimated Time of Departure');
            $table->string('eta')->nullable()->comment('Estimated Time of Arrival');


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
        Schema::dropIfExists('voucher_flight_details');
    }
};
