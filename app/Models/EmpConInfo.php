<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpConInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'postcode',
        'se_add',
        'street_address',
        'state',
        'city',
        'ctyzen_country',
        'add_proof',
];
public function empconinfo()
{
    return $this->belongsTo(Employee::class);
}
}
