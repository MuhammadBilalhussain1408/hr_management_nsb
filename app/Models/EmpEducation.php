<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'qulification',
        'subject',
        'institute',
        'uni',
        'passing_year',
        'percent',
        'grade',
        'doc_tran',
        'doc_cer',
];


}