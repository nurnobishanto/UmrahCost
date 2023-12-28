<?php

use App\Models\Package;
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
        Schema::create('service_voucher_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Package::class)->nullable();
            $table->json('company_title')->nullable();
            $table->json('company_name')->nullable();

            $table->longText('service_included')->nullable();
            $table->longText('service_excluded')->nullable();
            $table->longText('support_staf')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            
            $table->json('career')->nullable();
            $table->json('flight_no')->nullable();
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->json('etd')->nullable()->comment('Estimated Time of Departure');
            $table->json('eta')->nullable()->comment('Estimated Time of Arrival');

            
            $table->json('helpline_location')->nullable();
            $table->json('helpline_number')->nullable();
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
        Schema::dropIfExists('service_voucher_settings');
    }
};
