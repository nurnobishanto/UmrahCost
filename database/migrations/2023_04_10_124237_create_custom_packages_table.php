<?php

use App\Models\Airline;
use App\Models\Guide;
use App\Models\PackageType;
use App\Models\Status;
use App\Models\Transport;
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
        Schema::create('custom_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable()->comment('Client id');
            $table->foreignIdFor(PackageType::class)->nullable();
            $table->foreignIdFor(Airline::class)->nullable();
            $table->foreignIdFor(Transport::class)->nullable();
            $table->foreignIdFor(Guide::class)->nullable();
            $table->date('travel_date')->nullable();
            $table->string('nos_of_traveler')->nullable();
            $table->integer('total_stay')->default(0);
            $table->longText('note')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->boolean('visa_included')->default(0);
            $table->boolean('transport_included')->default(0);
            $table->boolean('guide_included')->default(0);
            $table->boolean('sightseeing_included')->default(0);
            $table->boolean('food_included')->default(0);
            $table->boolean('is_verified_otp')->default(0);
            $table->timestamps();

            $table->double('conversion_rate')->default(0);
            $table->double('airline_cost')->default(0);
            $table->double('transport_cost')->default(0);
            $table->double('guide_cost')->default(0);
            $table->double('visa_cost')->default(0);
            $table->double('food_cost')->default(0);


            $table->foreignIdFor(Status::class)->nullable();
            $table->boolean('mail_sent')->default(0);
            $table->unsignedBigInteger('mail_sent_by')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_packages');
    }
};
