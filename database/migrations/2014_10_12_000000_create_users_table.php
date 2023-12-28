<?php

use App\Models\ClientSource;
use App\Models\ClientStatus;
use App\Models\QueryAbout;
use App\Models\Status;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_type')->default('client')->comment('admin,crm,client');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->longText('query_details')->nullable();
            $table->longText('notes')->nullable();
            $table->double('number_of_person', 25)->default(1);
            $table->string('tour_month')->nullable();
            $table->foreignIdFor(QueryAbout::class)->nullable();
            $table->foreignIdFor(ClientSource::class)->nullable();
            $table->unsignedBigInteger('crm_id')->nullable();
            $table->foreignIdFor(Status::class)->nullable();
            $table->foreignIdFor(ClientStatus::class)->nullable();
            $table->boolean('status')->default(1);
            $table->string('avatar')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('otp_verified')->default(0);
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};
