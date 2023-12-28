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
        Schema::create('voucher_transportations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceVoucher::class)->nullable();
            $table->date('date')->nullable();
            $table->string('from')->nullable();
            $table->string('from_location')->nullable();
            $table->string('to')->nullable();
            $table->string('to_location')->nullable();
            $table->string('movement')->nullable();
            $table->string('vehicle')->nullable();
            $table->integer('qty')->nullable();
            $table->string('transport')->nullable();
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
        Schema::dropIfExists('voucher_transportations');
    }
};
