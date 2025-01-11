<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','organization_id','status'
    ];
    public function dayoff()
    {
        return $this->belongsTo('App\Models\Day_off','department_id');
    }
    
}
