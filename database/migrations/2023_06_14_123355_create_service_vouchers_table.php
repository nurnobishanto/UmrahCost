<?php

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
        Schema::create('service_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            
            $table->longText('service_included')->nullable();
            $table->longText('service_excluded')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->longText('support_staf')->nullable();

            $table->json('helpline_location')->nullable();
            $table->json('helpline_number')->nullable();

            $table->foreignIdFor(Status::class)->nullable();
            $table->boolean('mail_sent')->default(0);
            $table->unsignedBigInteger('mail_sent_by')->nullable();

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
        Schema::dropIfExists('service_vouchers');
    }
};
