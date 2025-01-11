<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'title',
        'start_date',
        'end_date',
        'year_exp',
        'passing_year',
        'description',
];
public function empjob()
{
    return $this->belongsTo(Employee::class,'');
}
}
