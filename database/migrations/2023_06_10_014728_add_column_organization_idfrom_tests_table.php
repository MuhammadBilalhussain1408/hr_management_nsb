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
        Schema::table('job_publisheds', function (Blueprint $table) {
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->text('job_des')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_publisheds', function (Blueprint $table) {
            $table->dropColumn('job_title','department','job_des');
        });
    }
};
