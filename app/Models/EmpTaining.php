<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpTaining extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'title',
        'start_date',
        'end_date',
        'description',
];
public function emptaining()
{
    return $this->belongsTo(Employee::class);
}
}
