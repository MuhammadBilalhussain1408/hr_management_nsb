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
        Schema::create('late_policies', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('shift_id');
            $table->integer('max_grace');
            $table->integer('days_allow');
            $table->integer('day_salary_deduc');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('late_policies');
    }
};
