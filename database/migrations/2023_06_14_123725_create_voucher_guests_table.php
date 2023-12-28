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
        Schema::create('voucher_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceVoucher::class)->nullable();
            $table->string('name')->nullable();
            $table->string('passport_no')->nullable();
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
        Schema::dropIfExists('voucher_guests');
    }
};
