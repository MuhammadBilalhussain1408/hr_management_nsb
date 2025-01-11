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
        Schema::create('emp_nids', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('nid')->nullable();
            $table->string('nid_nation')->nullable();
            $table->string('nid_resi')->nullable();
            $table->date('nid_issued_date')->nullable();
            $table->date('nid_expiry_date')->nullable();
            $table->date('nid_eligible_date')->nullable();
            $table->text('nid_proof')->nullable();
            $table->text('nid_status')->nullable();
            $table->string('nid_remarks')->nullable();
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
        Schema::dropIfExists('emp_nids');
    }
};
