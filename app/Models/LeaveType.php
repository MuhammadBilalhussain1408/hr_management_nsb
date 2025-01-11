<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'short_code','organization_id','slug','remarks'
    ];
}
