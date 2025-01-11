<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'organization_id',
        'start_date',
        'check_date',
        'evidence',
        'check_time',
        'check_photo',
        'check_dob',
        'expiry_time_limit',
        'restriction',
        'doc_genuine',
        'other_doc',
        'list_euss_date',
        'scan_doc1',
        'scan_doc2',
        'scan_doc3',
        'check_result',
        'remark',
        'list_right',
        'list_right_follow',
        'list_right_date',
        'list_group1',
        'list_group1_follow',
        'list_group1_date',
        'list_group2',
        'list_group2_follow',
        'list_group2_date',
        'list_tier4s',
        'list_tier4s_follow',
        'list_tier4s_date',
        'check_name',
        'check_phone',
        'check_email',
        'check_designation',
    ];
    public function checktypes()
    {
        return $this->belongsToMany('App\Models\Checktype', 'rightwork_has_checktype', 'right_work_id', 'checktype_id');
    }
    public function checkmidias()
    {
        return $this->belongsToMany('App\Models\Checkmidium', 'rightwork_has_checkmedia', 'right_work_id', 'checkmidia_id');
    }
    public function plists()
    {
        return $this->belongsToMany('App\Models\Physicallist', 'rightwork_has_physicallist', 'right_work_id', 'physicallist_id');
    }
    public function plist1g()
    {
        return $this->belongsToMany('App\Models\Physicallist1Group', 'rightwork_has_physical1group', 'right_work_id', 'physicallist1_group_id');
    }
    public function plist2g()
    {
        return $this->belongsToMany('App\Models\Physicallist2Group', 'rightwork_has_physical2group', 'right_work_id', 'physicallist2_group_id');
    }
    public function passports()
    {
        return $this->belongsToMany('App\Models\Passport', 'rightwork_has_passport', 'right_work_id', 'passport_id');
    }
    public function employees(){
        return $this->belongsToMany('App\Models\Employee','rightwork_has_employee', 'right_work_id', 'employee_id');
    }
}
