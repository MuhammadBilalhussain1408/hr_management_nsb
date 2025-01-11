<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug','meta_title','meta_keywords','meta_des','body','status'
    ];
    // public function contents(){
    //     return $this->belongsToMany('App\Models\Content', 'content_hasmenu', 'menu_id', 'content_id');
    // }
    public function contents(){
        return $this->hasMany('App\Models\Content','menu_id');
    }
    public function submenus(){
        return $this->hasMany('App\Models\Submenu','menu_id');
    }
}
