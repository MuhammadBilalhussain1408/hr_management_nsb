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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('organization_id');
            $table->string('lname')->nullable();
            $table->string('mid_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('ni_no')->nullable();
            $table->string('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email')->nullable();
            $table->string('con_number')->nullable();
            $table->string('al_contact')->nullable();
            $table->string('department_id')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('employee_type_id')->nullable();
            $table->string('join_date')->nullable();
            $table->string('emp_type')->nullable();
            $table->string('date_confirm')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('job_location')->nullable();
            $table->string('image')->nullable();
            $table->string('report_author')->nullable();
            $table->string('leave_author')->nullable();
            $table->string('passport_no')->nullable();
            $table->text('pass_nationality')->nullable();
            $table->string('bith_place')->nullable();
            $table->text('issued_by')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('eligible_for')->nullable();
            $table->text('pr_add_proof')->nullable();
            $table->string('crn_passport')->nullable();
            $table->text('passport_remarks')->nullable();
            $table->string('visa_no')->nullable();
            $table->text('visa_nation')->nullable();
            $table->string('visa_resi')->nullable();
            $table->string('v_issued_by')->nullable();
            $table->date('v_issued_date')->nullable();
            $table->date('v_expiry_date')->nullable();
            $table->date('v_eligible_date')->nullable();
            $table->text('vf_proof')->nullable();
            $table->string('vb_proof')->nullable();
            $table->text('crn_visa')->nullable();
            $table->text('visa_remarks')->nullable();
            $table->string('euss_no')->nullable();
            $table->text('euss_nation')->nullable();
            $table->text('e_issued_by')->nullable();
            $table->date('e_issued_date')->nullable();
            $table->date('e_expiry_date')->nullable();
            $table->date('e_eligible_date')->nullable();
            $table->string('euss_proof')->nullable();
            $table->text('crn_status')->nullable();
            $table->string('euss_remarks')->nullable();
            $table->string('dbs_type')->nullable();
            $table->text('dbs_no')->nullable();
            $table->text('dbs_nation')->nullable();
            $table->string('dbs_issued_by')->nullable();
            $table->date('dbs_issued_date')->nullable();
            $table->date('dbs_expiry_date')->nullable();
            $table->date('dbs_eligible_date')->nullable();
            $table->text('dbs_proof')->nullable();
            $table->string('dbs_status')->nullable();
            $table->text('dbs_remarks')->nullable();

            $table->date('license')->nullable();
            $table->text('license_number')->nullable();
            $table->string('li_start_date')->nullable();
            $table->text('li_end_date')->nullable();

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
        Schema::dropIfExists('table_employees');
    }
};
