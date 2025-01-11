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
        Schema::create('right_works', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('organization_id');
            $table->string('start_date')->nullable();
            $table->string('check_date')->nullable();
            $table->string('evidence')->nullable();
            $table->string('check_time')->nullable();
            $table->enum('check_photo',['Yes', 'No', 'N/A'])->default('Yes');
            $table->enum('check_dob' ,['Yes', 'No', 'N/A'])->default('Yes');
            $table->enum('expiry_time_limit',['Yes', 'No', 'N/A'])->default('Yes');
            $table->enum('restriction',['Yes', 'No', 'N/A'])->default('Yes');
            $table->enum('doc_genuine',['Yes', 'No', 'N/A'])->default('Yes');
            $table->enum('other_doc',['Yes', 'No', 'N/A'])->default('Yes');
            $table->string('list_euss_date')->nullable();
            $table->string('scan_doc1')->nullable();
            $table->string('scan_doc2')->nullable();
            $table->string('scan_doc3')->nullable();
            $table->string('check_result')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('right_works');
    }
};
