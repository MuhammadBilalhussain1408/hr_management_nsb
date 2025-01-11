<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('job_id');
            $table->string('job_title');
            $table->string('department');
            $table->string('description');
            $table->string('job_type');
            $table->string('working_hr');
            $table->string('experience_min');
            $table->string('experience_max');
            $table->string('salary_min');
            $table->string('salary_max');
            $table->string('period');
            $table->string('no_of_vacancies');
            $table->string('job_location');
            $table->string('qualification');
            $table->string('skill_set');
            $table->string('age_min');
            $table->string('age_max');
            $table->string('gender');
            $table->string('posting_date');
            $table->string('closing_date');
            $table->string('author');
            $table->string('author_desig');
            $table->string('author_desig');
            $table->string('email');
            $table->string('new_role');
            $table->string('language_required');
            $table->string('other');
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
        Schema::dropIfExists('job_posts');
    }
};
