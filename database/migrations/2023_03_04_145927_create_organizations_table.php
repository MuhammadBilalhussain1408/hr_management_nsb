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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('org_type')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('org_email')->nullable();
            $table->string('land_phone')->nullable();
            $table->string('trad_name')->nullable();
            $table->string('com_year')->nullable();
            $table->string('com_nat')->nullable();
            $table->string('nature_type')->nullable();
            $table->string('trad_status')->nullable();
            $table->string('status')->nullable();
            $table->string('trad_other')->nullable();
            $table->string('penlty_status')->nullable();
            $table->string('penlty_other')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('con_num')->nullable();
            $table->string('authemail')->nullable();
            $table->string('proof')->nullable();
            $table->string('bank_status')->nullable();
            $table->string('bank_other')->nullable();
            $table->string('key_person')->nullable();
            $table->string('key_f_name')->nullable();
            $table->string('key_f_lname')->nullable();
            $table->string('key_designation')->nullable();
            $table->string('key_phone')->nullable();
            $table->string('key_email')->nullable();
            $table->string('key_proof')->nullable();
            $table->string('key_bank_status')->nullable();
            $table->string('key_bank_other')->nullable();
            $table->string('level_person')->nullable();
            $table->string('level_f_name')->nullable();
            $table->string('level_f_lname')->nullable();
            $table->string('level_designation')->nullable();
            $table->string('level_phone')->nullable();
            $table->string('level_email')->nullable();
            $table->string('level_proof')->nullable();
            $table->string('level_bank_status')->nullable();
            $table->string('level_bank_other')->nullable();
            $table->string('zip')->nullable();
            $table->string('se_add')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('road')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
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
        Schema::dropIfExists('organizations');
    }
};
