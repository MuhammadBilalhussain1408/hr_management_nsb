<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpEuss extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'euss_no',
        'euss_nation',
        'e_issued_by',
        'e_issued_date',
        'e_expiry_date',
        'e_eligible_date',
        'euss_proof',
        'crn_status',
        'euss_remarks'
];
public function empeuss()
{
    return $this->belongsTo(Employee::class);
}
}