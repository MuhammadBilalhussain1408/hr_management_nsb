<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDbs extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'dbs_type',
        'dbs_no',
        'dbs_nation',
        'dbs_issued_by',
        'dbs_issued_date',
        'dbs_expiry_date',
        'dbs_eligible_date',
        'dbs_proof',
        'dbs_status',
        'dbs_remarks'
];
public function empdbs()
{
    return $this->belongsTo(Employee::class);
}
}
