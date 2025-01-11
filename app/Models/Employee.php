<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $dates = [ 'end_date'=>'datetime'];
    protected $fillable = [
            'organization_id',
            'code',
            'fname',
            'lname',
            'mid_name',
            'gender',
            'ni_no',
            'dob',
            'marital_status',
            'nationality',
            'email',
            'con_number',
            'al_contact',
            'department_id',
            'designation_id',
            'join_date',
            'employee_type_id',
            'date_confirm',
            'start_date',
            'end_date'=>'datetime',
            'job_location',
            'image',
            'report_author',
            'leave_author',
            'status',
            'license',
            'license_number',
            'li_start_date',
            'li_end_date',
            'passport_no',
            'pass_nationality',
            'bith_place',
            'issued_by',
            'expiry_date',
            'eligible_for',
            'pr_add_proof',
            'crn_passport',
            'passport_proof',
            'passport_remarks',
            'visa_no',
            'visa_nation',
            'visa_resi',
            'v_issued_by',
            'v_issued_date',
            'v_expiry_date',
            'v_eligible_date',
            'vf_proof',
            'vb_proof',
            'crn_visa',
            'visa_remarks',
            'euss_no',
            'euss_nation',
            'e_issued_by',
            'e_issued_date',
            'e_expiry_date',
            'e_eligible_date',
            'euss_proof',
            'crn_status',
            'euss_remarks',
            'dbs_type',
            'dbs_no',
            'dbs_nation',
            'dbs_issued_by',
            'dbs_issued_date',
            'dbs_expiry_date',
            'dbs_eligible_date',
            'dbs_proof',
            'dbs_status',
            'dbs_remarks',
            'date_change',
            'home',
            'hr',
            'res_remark'

    ];

    public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
    public function emp_type()
    {
        return $this->belongsTo('App\Models\EmployeeType','employee_type_id');
    }
    public function emptax(){
        return $this->belongsToMany('App\Models\Taxable', 'emp_has_tax', 'employee_id', 'taxable_id');
    }
    public function empdiduc(){
        return $this->belongsToMany('App\Models\Diduction', 'emp_has_tax', 'employee_id', 'taxable_id');
    }
    public function empedu(){
        return $this->hasMany('App\Models\EmpEducation');
    }
    public function emp_jobs(){
        return $this->hasMany('App\Models\EmpJob');
    }
    public function emp_taining(){
        return $this->hasMany('App\Models\EmpTaining');
    }
    public function emp_econ(){
        return $this->hasOne('App\Models\EmpEmergCon');
    }
    public function emp_coninfo(){
        return $this->hasOne('App\Models\EmpConInfo');
    }
    public function emp_odetails(){
        return $this->hasMany('App\Models\EmpOther');
    }
    public function emp_passport(){
        return $this->hasOne('App\Models\EmpPassport');
    }
    public function emp_visa(){
        return $this->hasOne('App\Models\EmpVisa');
    }
    public function emp_euss(){
        return $this->hasOne('App\Models\EmpEuss');
    }
    public function emp_dbs(){
        return $this->hasOne('App\Models\EmpDbs');
    }
    public function emp_nid(){
        return $this->hasOne('App\Models\EmpNid');
    }
    public function emp_odoc(){
        return $this->hasMany('App\Models\EmpODoc');
    }
    public function emp_pay(){
        return $this->hasOne('App\Models\EmpPay');
    }
    public function leave_allocation()
    {
        return $this->belongsTo(LeaveAllocation::class,'id');
    }
}
