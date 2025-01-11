<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['date'];

    protected $fillable = [

        'organization_id',
        'employee_id',
        'department_id',
        'designation_id',
        'shift_id',
        'date',
        'checked_in',
        'checked_out',
        'checked_in_loc',
        'checked_out_loc',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'status',
    ];
    public function scopeCreatedYear($query, $year)
    {
        return $query->whereYear('date', $year);
    }
    public function scopeCreatedMonth($query, $month)
    {
        return $query->whereYear('date', $month);
    }
    public function emp()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
}
