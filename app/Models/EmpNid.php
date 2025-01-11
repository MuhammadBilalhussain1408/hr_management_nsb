<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpNid extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'nid',
        'nid_nation',
        'nid_resi',
        'nid_issued_date',
        'nid_expiry_date',
        'nid_eligible_date',
        'nid_proof',
        'nid_status',
        'nid_remarks'
];
public function empnid()
{
    return $this->belongsTo(Employee::class);
}
}
