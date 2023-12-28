<?php

use App\Models\CustomPackage;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\RoomType;
use App\Models\Sightseeing;
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
        Schema::create('custom_package_hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CustomPackage::class)->nullable();
            $table->foreignIdFor(Hotel::class)->nullable();
            $table->foreignIdFor(Location::class)->nullable();
            $table->foreignIdFor(RoomType::class)->nullable();
            $table->foreignIdFor(Sightseeing::class)->nullable();
            $table->double('room_cost')->default(0)->comment('Room cost per day for all travelers');
            $table->double('sightseeing_cost')->default(0);
            $table->integer('stay_in')->default(0);
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
        Schema::dropIfExists('custom_package_hotels');
    }
};
