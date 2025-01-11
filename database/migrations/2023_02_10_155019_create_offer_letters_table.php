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
        Schema::create('offer_letters', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('job_applied_id');
            $table->string('offer_salary');
            $table->string('payment_type');
            $table->string('date_of_join');
            $table->string('report_authority');
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
        Schema::dropIfExists('offer_letters');
    }
};
