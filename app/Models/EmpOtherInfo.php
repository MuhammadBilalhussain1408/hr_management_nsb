<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpOtherInfo extends Model
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
public function empoinfo()
{
    return $this->belongsTo(Employee::class);
}
}
