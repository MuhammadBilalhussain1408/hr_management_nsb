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
            $table->string('list_right')->nullable();
            $table->string('list_right_follow')->nullable();
            $table->string('list_right_date')->nullable();
            $table->string('list_group1')->nullable();
            $table->string('list_group1_follow')->nullable();
            $table->string('list_group1_date')->nullable();
            $table->string('list_group2')->nullable();
            $table->string('list_group2_follow')->nullable();
            $table->string('list_group2_date')->nullable();
            $table->string('list_tier4s')->nullable();
            $table->string('list_tier4s_follow')->nullable();
            $table->string('list_tier4s_date')->nullable();
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
            $table->dropColumn('list_right');
        });
    }
};
