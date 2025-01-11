<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'status','organization_id','bank_id'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
