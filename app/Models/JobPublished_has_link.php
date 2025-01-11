<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPublished_has_link extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_published_id','link','image',
     ];
     
}
