<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpVisa extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'visa_no',
        'visa_nation',
        'visa_resi',
        'v_issued_by',
        'v_issued_date',
        'v_expiry_date',
        'v_eligible_date',
        'vf_proof',
        'vb_proof',
        'crn_visa',
        'visa_remarks'
];
public function empvisa()
{
    return $this->belongsTo(Employee::class);
}
}
