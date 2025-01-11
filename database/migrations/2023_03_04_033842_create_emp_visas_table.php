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
        Schema::create('emp_visas', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('visa_no')->nullable();
            $table->text('visa_nation')->nullable();
            $table->string('visa_resi')->nullable();
            $table->string('v_issued_by')->nullable();
            $table->date('v_issued_date')->nullable();
            $table->date('v_expiry_date')->nullable();
            $table->date('v_eligible_date')->nullable();
            $table->text('vf_proof')->nullable();
            $table->string('vb_proof')->nullable();
            $table->text('crn_visa')->nullable();
            $table->text('visa_remarks')->nullable();
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
        Schema::dropIfExists('emp_visas');
    }
};
