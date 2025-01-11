<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualPay extends Model
{
    use HasFactory;
    protected $fillable = [
        'annual_pay','organization_id', 'pay_group_id'
    ];
}
