<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpEmergCon extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'name',
        'relation',
        'emg_email',
        'emg_phone',
        'emg_address',
];
public function empemg()
{
    return $this->belongsTo(Employee::class);
}
}
