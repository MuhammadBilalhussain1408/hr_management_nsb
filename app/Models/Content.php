<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','menu_id','submenu_id', 'meta_title','meta_keywords','meta_des','image','image2','body','status'
    ];
    public function menus()
    {
        return $this->belongsTo('App\Models\Menu','menu_id');
    }
    public function submenus()
    {
        return $this->belongsTo('App\Models\Submenu','submenu_id');
    }
}
