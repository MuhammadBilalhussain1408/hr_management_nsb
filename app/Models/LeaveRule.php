<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'employee_type_id','organization_id','slug','leave_type_id','max_no','effect_from','effect_to'
    ];
    public function leave_types()
    {
        return $this->belongsTo('App\Models\LeaveType','leave_type_id');
    }
    public function emp_types()
    {
        return $this->belongsTo('App\Models\EmployeeType','employee_type_id');
    }
}
