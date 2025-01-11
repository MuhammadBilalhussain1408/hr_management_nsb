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
        Schema::create('emp_passports', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('passport_no')->nullable();
            $table->text('nationality')->nullable();
            $table->string('bith_place')->nullable();
            $table->text('issued_by')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('eligible_for')->nullable();
            $table->text('pr_add_proof')->nullable();
            $table->string('crn_passport')->nullable();
            $table->text('passport_remarks')->nullable();
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
        Schema::dropIfExists('emp_passports');
    }
};
