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
        Schema::create('emp_dbs', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('dbs_type')->nullable();
            $table->text('dbs_no')->nullable();
            $table->text('dbs_nation')->nullable();
            $table->string('dbs_issued_by')->nullable();
            $table->date('dbs_issued_date')->nullable();
            $table->date('dbs_expiry_date')->nullable();
            $table->date('dbs_eligible_date')->nullable();
            $table->text('dbs_proof')->nullable();
            $table->string('dbs_status')->nullable();
            $table->text('dbs_remarks')->nullable();
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
        Schema::dropIfExists('emp_dbs');
    }
};
