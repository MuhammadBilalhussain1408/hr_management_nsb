<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','menu_id', 'meta_title','meta_keywords','meta_des','image','body','status'
    ];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu','menu_id');
    }
    public function contents(){
        return $this->hasMany('App\Models\Content','menu_id');
    }
 
}
