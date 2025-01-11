<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LatePolicy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'organization_id',
        'department_id',
        'designation_id',
        'shift_id',
        'max_grace',
        'days_allow',
        'day_salary_deduc',
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
    public function shift()
    {
        return $this->belongsTo('App\Models\Shift','shift_id');
    }
}
