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
        Schema::table('right_works', function (Blueprint $table) {
            $table->string('check_name')->nullable();
            $table->string('check_phone')->nullable();
            $table->string('check_email')->nullable();
            $table->string('check_designation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('right_works', function (Blueprint $table) {
            $table->dropColumn('check_name');
        });
    }
};
