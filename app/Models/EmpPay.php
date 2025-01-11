<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpPay extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'emp_group_name',
        'emp_pay_scale',
        'wedges_paymode',
        'emp_payment_type',
        'daily',
        'min_work',
        'min_rate',
        'tax_emp',
        'tax_ref',
        'tax_per',
        'emp_pay_type',
        'emp_bank_name',
        'bank_branch_id',
        'emp_account_no',
        'emp_sort_code',
        'currency',
];
public function emppay()
{
    return $this->belongsTo(Employee::class);
}
}
