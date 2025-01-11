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
        Schema::create('leave_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_id');
            $table->string('employee_type_id');
            $table->string('leave_type_id');
            $table->string('employee_id');
            $table->string('slug');
            $table->string('max_no')->nullable();
            $table->string('leave_hand')->nullable();
            $table->string('effect_year')->nullable();
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
        Schema::dropIfExists('leave_allocations');
    }
};
