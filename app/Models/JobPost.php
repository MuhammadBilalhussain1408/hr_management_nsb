<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id','slug','job_title','department','job_des','job_code','job_type','working_hr','experience_min','experience_max','salary_min','salary_max','period','no_vac','job_location','qualification','skill_set','age_min','age_max','gender','posting_date','closing_date','author','author_desig','con_num','email','new_role','language_required','other','status','organization_id'
    ];
    public function job(){
        return $this->belongsTo('App\Models\Job');
    }
}
