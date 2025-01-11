<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpOther extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'title',
        'doc',
];
public function empother()
{
    return $this->belongsTo(Employee::class);
}
}
