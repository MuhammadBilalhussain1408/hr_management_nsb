@extends('layouts.app-wizard')
@section('content')
<link href="{{asset('assets/css/steps.css')}}" rel="stylesheet" type="text/css">
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('RightWork-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/right_works')}}">right_works</a></li>
                            <li class="breadcrumb-item active">Create New right_works </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New right works </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.right_works.index') }}"> Back</a>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        {!! Form::model($rightWork, ['method' => 'PATCH','route' => ['hrm.right_works.update',
                        $rightWork->id],'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data']) !!}

                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <div class="multisteps-form__content">
                                <h3> Right to Work Checklist (RTW)</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="employee_id" class="placeholder">Name of person </label>
                                            <select class="form-control" id="employee_id" name="employee_id">
                                                <option value="{{$datas['employee']['id']}}">{{$datas['employee']['fname']}} {{$datas['employee']['mid_name']}} {{$datas['employee']['lname']}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="start_date" class="placeholder">Work start date</label>
                                            <input id="start_date" type="date" class="form-control input-border-bottom" name="start_date" value="{{$rightWork->start_date}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control input-border-bottom" required="" name="organization_id" value="{{$organization->id}}">

                                            <label for="check_date" class="placeholder">Date of Check</label>
                                            <input id="check_date" type="date" class="form-control input-border-bottom" name="check_date" value="{{$rightWork->check_date}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_idnew" class="placeholder">Name of person </label>
                                        <input class="form-control" id="employee_idnew" type="text" name="employee_idnew" value="{{$datas['employee']['fname']}} {{$datas['employee']['mid_name']}} {{$datas['employee']['lname']}}" required="" disabled="" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date_new" class="placeholder">Work start date</label>
                                        <input id="start_date_new" type="date" class="form-control" name="start_date_new" value="{{$rightWork->start_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6>Type of check</h6>
                                        @forelse ($datas['checktypes'] as $key => $chk)
                                        @if($rightWork['checktypes'][0]['id'] == $chk->id)
                                        <input type="checkbox" id="checktype_id" name="checktype_id[]" value="{{$chk->id}}" checked>
                                        <label for="vehicle1">{{$chk->name}}</label>&nbsp; &nbsp; &nbsp;
                                        @else
                                        <input type="checkbox" id="checktype_id" name="checktype_id[]" value="{{$chk->id}}">
                                        <label for="vehicle1">{{$chk->name}}</label>&nbsp; &nbsp; &nbsp;
                                        @endif
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6>Medium of check</h6>
                                        @forelse ($datas['checkmidias'] as $key => $midia)

                                        <input type="checkbox" id="gender" name="checkmidia_id[]" value="{{$midia->id}}" checked>
                                        <label for="vehicle1">{{$midia->name}}</label>&nbsp; &nbsp; &nbsp;

                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="evidence" class="placeholder">Evidence presented </label>
                                        <select class="form-control input-border-bottom" id="evidence" name="evidence">
                                            <option value="{{$rightWork->evidence}}">{{$rightWork->evidence}}</option>
                                            <option value="Passport Document">Passport Document</option>
                                            <option value="Proof Of Correspondence Address">Proof Of Correspondence Address</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="check_time" class="placeholder">Time of check</label>
                                        <input id="check_time" type="text" class="form-control input-border-bottom" name="check_time" value="{{$rightWork->check_time}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p> You may conduct a physical document check or perform an online check to establish a right to work. Where a right to work check has been conducted using the online service, the information is provided in real-time, directly from Home Office systems and there is no requirement to see the documents listed below. </p>
                                        <h6>Step1 for physical check</h6>
                                        <p> You must obtain original documents from either List A or List B of acceptable documents for a manual right to work check.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">List A</div>
                                </div>
                                @forelse ($datas['plists'] as $key => $list)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                @if($rightWork['plists'][0]['id'] == $list->id)
                                                <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$list->id}}" checked>
                                                @else
                                                <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$list->id}}">
                                                @endif
                                                {{$list->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">List B Group 1</div>
                                </div>
                                @forelse ($datas['plist1g'] as $key => $l1g)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                
                                                <input type="checkbox" class="form-check-input" id="physicallist1_group_id" name="physicallist1_group_id[]" value="{{$l1g->id}}">
                                               
                                                {{$l1g->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">List B Group 2</div>
                                </div>
                                @forelse ($datas['plist2g'] as $key => $l2g)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                @forelse ($rightWork->plist2g as $pl2g)
                                                @if($pl2g->physicallist2_group_id == $l2g->id)
                                                <input type="checkbox" class="form-check-input" id="physicallist2_group_id" name="physicallist2_group_id[]" value="{{$l2g->id}}" checked>
                                                @else
                                                <input type="checkbox" class="form-check-input" id="physicallist2_group_id" name="physicallist2_group_id[]" value="{{$l2g->id}}">
                                                @endif
                                                @empty
                                                <input type="checkbox" class="form-check-input" id="physicallist2_group_id" name="physicallist2_group_id[]" value="{{$l2g->id}}">
                                                @endforelse
                                                {{$l2g->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Check step 2</h3>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        You must check that the documents are genuine and that the person presenting them is the prospective employee or employee, the rightful holder and allowed to do the type of work you are offering.
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">
                                            1. Are photographs consistent across documents and with the person’s appearance?
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="check_photo" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="check_photo" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="check_photo" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">
                                            2. Are dates of birth correct and consistent across documents?
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="check_dob" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="check_dob" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="check_dob" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">
                                            3. Are expiry dates for time-limited permission to be in the UK in the future i.e. they have not passed (if applicable)?
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">4. Have you checked work restrictions to determine if the person is able to work for you and do the type of work you are offering? (For students who have limited permission to work
                                            during termtime, you must also obtain, copy and retain details of their academic term and vacation times covering the duration of their period of study in the UK
                                            for which they will be employed.)
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="restriction" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="restriction" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="restriction" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">
                                            5. Are you satisfied the document is genuine, has not been tampered with and belongs to the holder?
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <p class="form-check-label">
                                            6. Have you checked the reasons for any different names across documents (e.g. marriage certificate, divorce decree, deed poll)? (Supporting documents should also be photocopied
                                            and a copy retained.)
                                        </p>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="other_doc" value="Yes" checked="">
                                            <span class="form-radio-sign">Yes</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="other_doc" value="No">
                                            <span class="form-radio-sign">No</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="other_doc" value="N/A">
                                            <span class="form-radio-sign">N/A</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab">
                            <h3>Step 3 Copy</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>You must make a clear copy of each document in a format which cannot later be altered, and retain the copy securely; electronically or in hardcopy. You must copy and retain:</p>
                                </div>
                                @forelse ($datas['passports'] as $key => $pass)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                             
                                                @forelse($rightWork->passports as $ps)
                                                @if($ps->passport_id == $pass->id)
                                                <input type="checkbox" class="form-check-input" id="passport_id" name="passport_id[]" value="{{$pass->id}}" checked>
                                                @else
                                                <input type="checkbox" class="form-check-input" id="passport_id" name="passport_id[]" value="{{$pass->id}}">
                                                @endif
                                                @empty
                                                <input type="checkbox" class="form-check-input" id="passport_id" name="passport_id[]" value="{{$pass->id}}">
                                                @endforelse
                                              
                                                {{$pass->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <h3>Know the type of excuse you have</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        If you have correctly carried out the above 3 steps you will have an excuse against liability for a civil penalty if the above named person is found working for you illegally. However, you need to be aware of the type of excuse you have as this determines how long it lasts for, and if, and when you are required to do a followup check.
                                    </p>
                                    <p> The documents that you have checked and copied are from:</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label"> List A
                                                <input type="checkbox" class="form-check-input" id="list_right" name="list_right" value="List A">
                                                You have a continuous statutory excuse for the full duration of the person’s employment with you. You are not required to carry out any repeat right to work checks on this.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label"> List B: Group 1
                                                <input type="checkbox" class="form-check-input" id="list_group" name="list_group" value="List B: Group 1">
                                                You have a time-limited statutory excuse which expires when the person’s permission to be in the UK expires. You should carry out a follow-up check when the
                                                document evidencing their permission to work expires.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label"> List B: Group 2
                                                <input type="checkbox" class="form-check-input" id="list_group2" name="list_group2" value="List B: Group 2">
                                                You have a time-limited statutory excuse which expires six months from the date specified in your Positive Verification Notice. This means that you should carry
                                                out a follow-up check when this notice expires.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Know the type of excuse you have</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Date followup required</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4">List B: Group 1</label>
                                        <div class="col-md-8">
                                            <input id="list_group1_date" type="date" class="form-control" name="list_group1_date" value="{{$rightWork->list_group1_date}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4">List B: Group 2</label>
                                        <div class="col-md-8">
                                            <input id="list_group2_date" type="date" class="form-control" name="list_group2_date" value="{{$rightWork->list_group2_date}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-4"> EUSS </label>
                                        <div class="col-md-8">
                                            <input id="list_euss_date" type="date" class="form-control" name="list_euss_date" value="{{$rightWork->list_euss_date}}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label>Select Document</label>

                                    <select class="form-control" id="scan_doc1" name="scan_doc1" onchange="checkscsnf(this.value);" aria-invalid="false">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                        <option value="pr_add_proof">Proof Of Correspondence Address </option>
                                        <option value="passport_proof">Passport Document </option>
                                    </select>
                                    <input type="hidden" id="scan_doc1_img" name="scan_doc1_img" value="">

                                    <div class="text-center">
                                        <div class="scan-hd">
                                            <h3>RTW Evidence Scans-1</h3>
                                        </div>

                                        <div class="scan-body" style="background: #edecec;">
                                            <embed name="imgeid" id="imgeid" width="50%" src="">
                                            <div id="scan_ne_id" style="display:none;margin-top:20px;">
                                                <img name="imgeidnew" id="imgeidnew" width="50%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label>Select Document</label>

                                    <select class="form-control" id="scan_doc2" name="scan_doc2" onchange="checkscan2(this.value);" aria-invalid="false">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                        <option value="pr_add_proof">Proof Of Correspondence Address </option>
                                        <option value="passport_proof">Passport Document </option>
                                    </select>
                                    <input type="hidden" id="scan_doc2_img" name="scan_doc2_img" value="">

                                    <div class="text-center">
                                        <div class="scan-hd">
                                            <h3>RTW Evidence Scans-2 (If applicable)</h3>
                                        </div>

                                        <div class="scan-body" style="background: #edecec;">
                                            <embed name="imgeid2" id="imgeid2" width="50%" src="">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label>Select Document</label>

                                    <select class="form-control" id="scan_doc3" name="scan_doc3" onchange="checkscan3(this.value);" aria-invalid="false">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                        <option value="pr_add_proof">Proof Of Correspondence Address </option>
                                        <option value="passport_proof">Passport Document </option>
                                    </select>
                                    <input type="hidden" id="scan_doc3_img" name="scan_doc3_img" value="">

                                    <div class="text-center">
                                        <div class="scan-hd">
                                            <h3>RTW Report</h3>
                                        </div>
                                        <div class="scan-body" style="background: #edecec;">
                                            <embed name="imgeid3" id="imgeid3" width="50%" src="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="result" class="control-label"> RTW check result </label>
                                        <select class="form-control input-border-bottom" id="result" name="result">
                                            <option value="{{$rightWork->result}}">{{$rightWork->result}}</option>
                                            <option value="Positive">Positive</option>
                                            <option value="Negative">Negative</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="remark" class="placeholder">Remark</label>
                                        <input id="remark" type="text" class="form-control" name="remark" value="$rightWork->remark">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname" class="placeholder">Checker Name</label>
                                        <input class="form-control" type="text" name="check_name" required="" value="{{$rightWork->check_name}} {{$organization->l_name}}">
                                    </div>
                                    <input type="hidden" class="form-control" name="emp_id" id="emp_id">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="con_number" class="placeholder">Contact Number</label>
                                        <input id="con_number" type="text" class="form-control" name="check_phone" value="{{$rightWork->check_phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation" class="placeholder">Designation</label>
                                        <input id="designation" type="text" class="form-control" name="check_designation" value="{{$rightWork->check_designation}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="placeholder">Email Address</label>
                                        <input id="email" type="email" class="form-control" name="check_email" value="{{$rightWork->check_email}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->

    <script>
        function chngdepartment(val) {
            var empid = val;
            //   console.log(empid);
            $.ajax({
                type: 'GET',
                url: '/get_emp/' + empid,
                cache: false,
                success: function(response) {

                    var obj = jQuery.parseJSON(response);
                    //   console.log(obj);
                    var id = obj.id;

                    $("#emp_id").val(id);

                    $("#emp_id").attr("readonly", true);

                    if (obj.start_date != '1970-01-01') {
                        $("#start_date").val(obj.start_date);
                        $("#start_date_new").val(obj.start_date);
                        $("#employee_idnew").val(obj.fname + obj.mid_name + obj.lname);
                        $("#email").val(obj.email);
                        $("#con_number").val(obj.con_number);
                        var input = document.getElementById("date");
                        var input = document.getElementById("text");
                        var input = document.getElementById("email");
                        //input.setAttribute("max", obj[0].emp_doj);
                    }
                    $("#start_date").attr("readonly", true);
                    $("#start_date_new").attr("readonly", true);
                    $("#employee_idnew").attr("readonly", true);
                    $("#email").attr("readonly", true);
                    $("#con_number").attr("readonly", true);
                    if (obj.start_date != '1970-01-01') {
                        $("#start_date").val(obj.start_date);
                        $("#start_date_new").val(obj.start_date);
                        $("#employee_idnew").val(obj.fname + obj.mid_name + obj.lname);
                        $("#email").val(obj.email);
                        $("#con_number").val(obj.con_number);
                    }

                    if (obj.visa_review_date != '1970-01-01') {
                        $("#list_rightb_date").val(obj.visa_review_date);
                    }

                }
            });
        }

        function checkscsnf(val) {
            var emp_id = $("#emp_id").val();
            $.ajax({
                type: 'GET',
                url: '/get_emp_doc/' + emp_id + '/' + val,
                cache: false,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    //  console.log(val);
                    if (val == 'passport_proof') {
                        var gg = "/upload/image/" + obj.passport_proof;
                        console.log(val);

                        $("#imgeid").attr("src", gg);
                        $("#scan_doc1_img").val(obj.passport_proof);
                    } else {
                        var gg = "/upload/image/" + obj.pr_add_proof;

                        $("#imgeid").attr("src", gg);
                        $("#scan_doc1_img").val(obj.pr_add_proof);
                    }
                }
            });
        }

        function checkscan2(val) {
            var emp_id = $("#emp_id").val();
            $.ajax({
                type: 'GET',
                url: '/get_emp_doc/' + emp_id + '/' + val,
                cache: false,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if (val == 'passport_proof') {
                        var gg = "/upload/image/" + obj.passport_proof;
                        //   console.log(obj);

                        $("#imgeid2").attr("src", gg);
                        $("#scan_doc2_img").val(obj.passport_proof);
                    } else {
                        var gg = "/upload/image/" + obj.pr_add_proof;

                        $("#imgeid2").attr("src", gg);
                        $("#scan_doc2_img").val(obj.pr_add_proof);
                    }
                }
            });
        }

        function checkscan3(val) {
            var emp_id = $("#emp_id").val();
            $.ajax({
                type: 'GET',
                url: '/get_emp_doc/' + emp_id + '/' + val,
                cache: false,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if (val == 'passport_proof') {
                        var gg = "/upload/image/" + obj.passport_proof;
                        //   console.log(obj);

                        $("#imgeid3").attr("src", gg);
                        $("#scan_doc3_img").val(obj.passport_proof);
                    } else {
                        var gg = "/upload/image/" + obj.pr_add_proof;

                        $("#imgeid3").attr("src", gg);
                        $("#scan_doc3_img").val(obj.pr_add_proof);
                    }
                }
            });
        }
    </script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = true;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
    <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_form_steps -->

    @include('layouts.footer')
    @endsection