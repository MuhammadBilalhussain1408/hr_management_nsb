<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplied extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_post_id','soc_code','name','email','phone', 'gender','total_year_of_exp','exp','exp_month','qualification','skill_set','recent_employee','recent_job_title','zip','address','expected_salary','current_stage_requitment','apply_from','remark','cover_letter','resume','organization_id','dob','status'
    ];
    public function jobpost(){
        return $this->belongsTo('App\Models\JobPost','job_post_id');
    }
}
