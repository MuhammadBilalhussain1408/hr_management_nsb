<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'org_type',
        'reg_no',
        'phone',
        'website',
        'org_email',
        'land_phone',
        'trad_name',
        'com_year',
        'sec_name',
        'nature_type',
        'trad_status',
        'trad_other',
        'penlty_status',
        'penlty_other',
        'image',
        'logo',
        'f_name',
        'l_name',
        'designation',
        'con_num',
        'authemail',
        'proof',
        'bank_status',
        'bank_other',
        'key_person',
        'key_f_name',
        'key_f_lname',
        'key_designation',
        'key_phone',
        'key_email',
        'key_proof',
        'key_bank_status',
        'key_bank_other',
        'level_person',
        'level_f_name',
        'level_f_lname',
        'level_designation',
        'level_phone',
        'level_email',
        'level_proof',
        'level_bank_status',
        'level_bank_other',
        'zip',
        'se_add',
        'address',
        'address1',
        'address2',
        'road',
        'city',
        'country',
        'post_code',
];
    // public function docs(){
    //     return $this->belongsToMany('App\Models\Organization', 'documents', 'id', 'organization_id');
    // }
    public function docs(){
        return $this->hasMany('App\Models\Document');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function trading(){
        return $this->hasMany('App\Models\Trading');
    }
    public function org_emp(){
        return $this->belongsTo('App\Models\Employee');
    }
}
