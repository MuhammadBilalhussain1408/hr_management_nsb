<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no','bill_date','status','organization_id','body','amount','bank_code','account_no'
    ];
    public function org(){
        return $this->belongsTo('App\Models\Organization','organization_id');
    }
}
