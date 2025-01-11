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
        Schema::create('emp_eusses', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('euss_no')->nullable();
            $table->text('euss_nation')->nullable();
            $table->text('e_issued_by')->nullable();
            $table->date('e_issued_date')->nullable();
            $table->date('e_expiry_date')->nullable();
            $table->date('e_eligible_date')->nullable();
            $table->string('euss_proof')->nullable();
            $table->text('crn_status')->nullable();
            $table->string('euss_remarks')->nullable();
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
        Schema::dropIfExists('emp_eusses');
    }
};
