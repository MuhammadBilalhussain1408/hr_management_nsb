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
        Schema::create('emp_o_docs', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('o_title')->nullable();
            $table->string('o_nation')->nullable();
            $table->date('o_issued_date')->nullable();
            $table->date('o_expiry_date')->nullable();
            $table->date('o_eligible_date')->nullable();
            $table->text('o_proof')->nullable();
            $table->text('o_remarks')->nullable();
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
        Schema::dropIfExists('emp_o_docs');
    }
};
