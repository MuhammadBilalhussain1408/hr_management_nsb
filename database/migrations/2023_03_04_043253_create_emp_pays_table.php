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
        Schema::create('emp_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('emp_group_name')->nullable();
            $table->string('emp_pay_scale')->nullable();
            $table->date('wedges_paymode')->nullable();
            $table->date('emp_payment_type')->nullable();
            $table->date('daily')->nullable();
            $table->text('min_work')->nullable();
            $table->text('min_rate')->nullable();
            $table->text('tax_emp')->nullable();
            $table->text('tax_ref')->nullable();
            $table->text('tax_per')->nullable();
            $table->text('emp_pay_type')->nullable();
            $table->text('emp_bank_name')->nullable();
            $table->text('bank_branch_id')->nullable();
            $table->text('emp_account_no')->nullable();
            $table->text('emp_sort_code')->nullable();
            $table->text('currency')->nullable();
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
        Schema::dropIfExists('emp_pays');
    }
};
