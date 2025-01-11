<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpODoc extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'o_title',
        'o_nation',
        'o_issued_date',
        'o_expiry_date',
        'o_eligible_date',
        'o_proof',
        'o_remarks'
];
public function empodoc()
{
    return $this->belongsTo(Employee::class);
}
}