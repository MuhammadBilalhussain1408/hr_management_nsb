<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpPassport extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'passport_no',
        'nationality',
        'bith_place',
        'issued_by',
        'expiry_date',
        'eligible_for',
        'pr_add_proof',
        'crn_passport',
        'passport_remarks'
];
public function emppassport()
{
    return $this->belongsTo(Employee::class);
}
}
