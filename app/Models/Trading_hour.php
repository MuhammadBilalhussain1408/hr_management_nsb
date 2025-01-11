<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trading_hour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];
}
