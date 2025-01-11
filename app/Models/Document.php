<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image','organization_id','user_id'
    ];
    public function docs(){
        return $this->belongsTo('App\Models\Organization');
    }
}
