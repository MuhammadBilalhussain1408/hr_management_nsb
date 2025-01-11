<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title','soc_code','job_des','department', 'status','organization_id'
    ];
    public function job(){
        return $this->belongsTo('App\Models\Job','job_published_id');
    }
}
