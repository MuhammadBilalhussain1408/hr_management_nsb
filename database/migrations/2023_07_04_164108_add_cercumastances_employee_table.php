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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('date_change')->nullable();
            $table->string('res_remark')->nullable();
            $table->string('hr')->nullable();
            $table->string('home')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('date_change');
            $table->dropColumn('res_remark');
            $table->dropColumn('hr');
            $table->dropColumn('home');
        });
    }
};
