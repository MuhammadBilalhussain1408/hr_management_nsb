<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'employee_type_id','organization_id','slug','leave_type_id','leave_rule_id','max_no','leave_hand','effect_year'
    ];
    public function leave_types()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }
    public function emp_types()
    {
        return $this->belongsTo(EmployeeType::class,'employee_type_id');
    }
    public function leave_rules()
    {
        return $this->belongsTo(LeaveRule::class,'leave_rule_id');
    }
    public function emp()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
