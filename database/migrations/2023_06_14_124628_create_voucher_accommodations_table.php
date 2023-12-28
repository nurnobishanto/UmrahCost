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
        Schema::create('voucher_accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceVoucher::class)->nullable();
            $table->string('city')->nullable();
            $table->string('hotel')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('night')->nullable();
            $table->string('hotel_by')->nullable();
            $table->string('confirm')->nullable();
            $table->string('meals')->nullable();
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
        Schema::dropIfExists('voucher_accommodations');
    }
};
