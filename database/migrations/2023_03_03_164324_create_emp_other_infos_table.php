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
        Schema::create('emp_other_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('postcode')->nullable();
            $table->string('se_add')->nullable();
            $table->string('street_address')->nullable();
            $table->string('village')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('ctyzen_country')->nullable();
            $table->text('add_proof')->nullable();
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
        Schema::dropIfExists('emp_other_infos');
    }
};
