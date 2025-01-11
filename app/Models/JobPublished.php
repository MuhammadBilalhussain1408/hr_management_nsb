<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPublished extends Model
{
    use HasFactory;
    protected $fillable = [
       'job_id','job_title','soc_code','job_des','department', 'status','organization_id'
    ];
    public function job(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
    public function job_published_link(){
        return $this->belongsTo('App\Models\JobPublished_has_link','job_published_has_link_id');
    }
}
