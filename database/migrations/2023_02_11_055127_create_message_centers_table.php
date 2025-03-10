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
        Schema::create('message_centers', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('job_applied_id');
            $table->string('email_cc');
            $table->string('subject');
            $table->string('description');
            $table->string('doc');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('message_centers');
    }
};
