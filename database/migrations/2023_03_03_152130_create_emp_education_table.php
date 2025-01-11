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
        Schema::create('emp_education', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('qulification')->nullable();
            $table->string('subject')->nullable();
            $table->string('institute')->nullable();
            $table->string('uni')->nullable();
            $table->string('passing_year')->nullable();
            $table->string('percent')->nullable();
            $table->string('grade')->nullable();
            $table->text('doc_tran')->nullable();
            $table->text('doc_cer')->nullable();
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
        Schema::dropIfExists('emp_education');
    }
};
