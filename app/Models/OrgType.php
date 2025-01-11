<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status'
    ];
    public function org_type(){
        return $this->hasOne('App\Models\Organization');
    }
}
