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
        Schema::create('day_offs', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('shift_id');
            $table->enum('monday', ['1', '0'])->default('1');
            $table->enum('tuesday', ['1', '0'])->default('1');
            $table->enum('wednesday', ['1', '0'])->default('1');
            $table->enum('thursday', ['1', '0'])->default('1');
            $table->enum('friday', ['1', '0'])->default('1');
            $table->enum('saturday', ['1', '0'])->default('1');
            $table->enum('sunday', ['1', '0'])->default('1');
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
        Schema::dropIfExists('day_offs');
    }
};
