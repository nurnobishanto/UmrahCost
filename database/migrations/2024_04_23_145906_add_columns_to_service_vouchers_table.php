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
        Schema::table('service_vouchers', function (Blueprint $table) {
            $table->string('group_no')->nullable();
            $table->longText('office_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_vouchers', function (Blueprint $table) {
            $table->dropColumn('group_no');
            $table->dropColumn('office_address');
        });
    }
};
