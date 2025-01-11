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
        Schema::create('job_applieds', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('jobpost_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('dob');
            $table->string('phone');
            $table->string('gender');
            $table->string('total_year_of_exp');
            $table->string('qualification');
            $table->string('skill_set');
            $table->string('recent_employee');
            $table->string('recent_job_title');
            $table->string('expected_salary');
            $table->string('current_stage_requitment');
            $table->string('apply_from');
            $table->string('remark');
            $table->string('date');           
            $table->string('status')->nullable();
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
        Schema::dropIfExists('job_applieds');
    }
};
