<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'organization_id',
        'department_id',
        'designation_id',
        'shift_code',
        'in_time',
        'out_time',
        'break_time_from',
        'break_time_to',
        'body',
        'created_by',
        'updated_by',
    ];
    public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
}
