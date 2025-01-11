<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DutyRoster extends Model
{
    use HasFactory , SoftDeletes;

      protected $fillable = [

        'organization_id',
        'department_id',
        'designation_id',
        'employee_id',
        'from_date',
        'to_date',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
    public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
    public function emp()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
