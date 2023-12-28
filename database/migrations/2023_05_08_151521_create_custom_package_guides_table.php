<?php

use App\Models\CustomPackage;
use App\Models\Guide;
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
        Schema::create('custom_package_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CustomPackage::class)->nullable();
            $table->foreignIdFor(Guide::class)->nullable();
            $table->double('guide_cost')->default(0)->comment('Guide Cost Per User');
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
        Schema::dropIfExists('custom_package_guides');
    }
};
