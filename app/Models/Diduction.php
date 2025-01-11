<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
];
public function empdiduc()
{
    return $this->belongsTo(Employee::class);
}
}
