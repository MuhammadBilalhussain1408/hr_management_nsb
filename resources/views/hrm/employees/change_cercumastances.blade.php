@extends('layouts.app-wizard')
@section('content')
<link href="{{asset('assets/css/steps.css')}}" rel="stylesheet" type="text/css">
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('employee-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/employees')}}">employees</a></li>
                            <li class="breadcrumb-item active"> Cercumastances </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Cercumastances </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.employees.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => ['hrm.change_cercumastances_emp', $employee->id],'method'=>'POST', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}
                    
                        <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                        <!-- One "tab" for each step in the form: -->
                      
                            <div class="multisteps-form__content">
                                <h3> Personal Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel1" class="placeholder">First Name <span
                                                    style="color:red;">*</span></label>
                                            <input id="inputFloatingLabel1" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}" required="" name="fname">
                                            <input type="hidden" class="form-control input-border-bottom"  required="" name="organization_id" value="{{Auth::user()->org->id}}">
                                            <input type="hidden" class="form-control input-border-bottom"  required="" name="employee_id" value="{{$employee->id}}">
                                            <input type="hidden" class="form-control input-border-bottom"  required="" name="company_name" value="{{Auth::user()->org->company_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel2" class="placeholder">Middle Name</label>
                                            <input id="inputFloatingLabel2" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->mid_name}}" name="mid_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel3" class="placeholder">Last Name <span
                                                    style="color:red;">*</span></label>
                                            <input id="inputFloatingLabel3" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->lname}}" name="lname" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectFloatingLabel" class="placeholder">Gender </label>
                                            <select class="form-control input-border-bottom"  id="selectFloatingLabel"
                                                name="gender">
                                                <option value="{{$employee->gender}}" selected>{{$employee->gender}}</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabelni" class="placeholder">NI No.</label>
                                            <input id="inputFloatingLabelni" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->ni_no}}" name="ni_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabeldob" style="padding-left: 10px;">Date of
                                                Birth
                                            </label>
                                            <input id="inputFloatingLabeldob" type="date"
                                                class="form-control input-border-bottom datepicker-here" name="dob" value="{{$employee->dob}}"
                                                data-language="en" data-position="top left">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectFloatingLabel1" class="placeholder">Marital
                                                Status</label>
                                            <select class="form-control input-border-bottom" id="selectFloatingLabel1"
                                                name="marital_status">
                                                <option value="{{$employee->marital_status}}" selected>{{$employee->marital_status}}</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Unmarried">Unmarried</option>
                                                <option value="Widow">Widow</option>
                                                <option value="Divorce">Divorce</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectFloatingLabel3" class="placeholder"> Select
                                                Nationality</label>
                                            <select class="form-control input-border-bottom"  id="selectFloatingLabel3"
                                                name="nationality">
                                                <option value="{{$employee->nationality}}">{{$employee->nationality}}</option>
                                                <option value="">Select</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabelfon" class="placeholder">Email <span
                                                    style="color:red;">*</span></label>
                                            <input id="inputFloatingLabelfon" type="email"
                                                class="form-control input-border-bottom"  value="{{$employee->email}}" required="" name="email">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone" class="placeholder">Contact Number
                                                <span style="color:red;">*</span></label>
                                            <input id="phone" type="tel" class="form-control input-border-bottom"  value="{{$employee->phone}}"
                                                required="" name="phone">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabelphonealter" class="placeholder">Alternative
                                                Number</label>
                                            <input id="inputFloatingLabelphonealter" type="tel"
                                                class="form-control input-border-bottom"  value="{{$employee->al_contact}}" name="al_contact">

                                        </div>
                                    </div>
                                </div>
                            

                            </div>
                      
                       
                            <h3>Contact Information (Correspondence Address)</h3>
                            <div class="multisteps-form__content">
                            @if($employee->emp_coninfo)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postcode" class="placeholder">Post Code</label>
                                            <input id="hidden" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->id}}"
                                                name="emp_cinfo_id">
                                            <input id="postcode" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->postcode}}"
                                                name="postcode">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="se_add" class="placeholder">Select Address </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->se_add}}" id="se_add" name="se_add">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="street_address" class="placeholder">Address Line
                                                1</label>
                                            <input id="street_address" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->street_address}}" name="street_address">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="village" class="placeholder">Address Line
                                                2</label>
                                            <input id="village" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->village}}"
                                                name="village">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="state" class="placeholder">Address Line 3</label>
                                            <input id="state" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->state}}"
                                                name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" class="placeholder">City / County</label>
                                            <input id="city" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->city}}"
                                                name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ctyzen_country" class="placeholder">Country</label>
                                            <select class="form-control input-border-bottom" name="country"
                                                id="country">
                                                <option value="{{$employee->country}}">{{$employee->country}}</option>
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="add_proof" class="placeholder">Proof Of Address</label>
                                            <input type="file" class="form-control " name="pr_add_proof" id="add_proof" value="{{$employee->emp_coninfo->add_proof}}">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postcode" class="placeholder">Post Code</label>
                                            <input id="postcode" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="postcode">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="se_add" class="placeholder">Select Address </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="se_add" name="se_add">
                                                <option value="">&nbsp;</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="street_address" class="placeholder">Address Line
                                                1</label>
                                            <input id="street_address" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="street_address">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="village" class="placeholder">Address Line
                                                2</label>
                                            <input id="village" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="village">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="state" class="placeholder">Address Line 3</label>
                                            <input id="state" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" class="placeholder">City / County</label>
                                            <input id="city" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ctyzen_country" class="placeholder">Country</label>
                                            <select class="form-control input-border-bottom" name="ctyzen_country"
                                                id="ctyzen_country">
                                                <option value="{{$employee->ctyzen_country}}">{{$employee->ctyzen_country}}</option>
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="add_proof" class="placeholder">Proof Of Address</label>
                                            <input type="file" class="form-control " name="pr_add_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                       
                      
                            <h3>Passport Details</h3>
                            <div class="multisteps-form__content">
                             
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_no" class="placeholder">Passport</label>
                                            <input id="passport_no" type="text" class="form-control input-border-bottom"  value="{{$employee->id}}"
                                                name="passport_id">
                                            <input id="passport_no" type="text" class="form-control input-border-bottom"  value="{{$employee->passport_no}}"
                                                name="passport_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="epass_nationality" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom" id="epass_nationality"
                                                name="epass_nationality">
                                                <option value="{{$employee->epass_nationality}}">{{$employee->epass_nationality}}</option>
                                                <option value="">Select</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bith_place" class="placeholder">Place of Birth</label>
                                            <input id="bith_place" type="text" class="form-control input-border-bottom"  value="{{$employee->bith_place}}"
                                                name="bith_place">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued By</label>
                                            <input id="issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->issued_by}}"
                                                name="issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="issued_by" type="date" class="form-control input-border-bottom"  value="{{$employee->issued_date}}"
                                                name="issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="expiry_date" type="date" class="form-control input-border-bottom"  value="{{$employee->expiry_date}}"
                                                name="expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eligible_for" class="placeholder">Eligible Review Date</label>
                                            <input id="eligible_for" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->eligible_for}}" name="eligible_for">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="add_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->passport_proof}}" name="passport_proof" id="passport_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current passport?</label><br>
                                            @if($employee->crn_passport == 'Yes')
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_passport"
                                                    value="Yes" checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_passport"
                                                    value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @else
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_passport"
                                                    value="Yes">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_passport"
                                                    value="No" checked="">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                        @endif      
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="passport_remarks" class="placeholder">Remarks</label>
                                            <input id="passport_remarks" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="passport_remarks">

                                        </div>
                                    </div>
                                </div>
                             
                                <h3> Visa / BRP Details</h3>
                               
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_no" class="placeholder">Visa No</label>
                                            <input id="visa_id" type="hidden" class="form-control input-border-bottom"  value="{{$employee->id}}"
                                                name="visa_id">
                                            <input id="visa_no" type="text" class="form-control input-border-bottom"  value="{{$employee->visa_no}}"
                                                name="visa_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  id="visa_nation"
                                                name="visa_nation">
                                                <option value="{{$employee->visa_nation}}">{{$employee->visa_nation}}</option>
                                                <option value="">Select</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom" id="visa_resi"
                                                name="visa_resi">
                                                <option value="{{$employee->visa_resi}}">{{$employee->visa_resi}} </option>
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_issued_by" class="placeholder">Issued By</label>
                                            <input id="v_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->v_issued_by}}"
                                                name="v_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="v_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->v_issued_date}}" name="v_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="v_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->v_expiry_date}}" name="v_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="v_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->v_eligible_date}}" name="v_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vf_proof" class="placeholder">Upload Front Side Document</label>
                                            <input type="file" class="form-control" value="{{$employee->vf_proof}}" name="vf_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vb_proof" class="placeholder">Upload Back Side Document</label>
                                            <input type="file" class="form-control"  value="{{$employee->vb_proof}}" name="vb_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current visa?</label><br>
                                            @if($employee->crn_visa == 'Yes')
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="Yes"
                                                    checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @else
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="Yes">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="No"  checked="">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="visa_remarks" class="placeholder">Remarks</label>
                                            <input id="visa_remarks" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->visa_remarks}}" name="visa_remarks">

                                        </div>
                                    </div>
                                </div>
                              
                                <h3 class="title"> EUSS/Time limit details </h3>
                              
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_no" class="placeholder">Reference Number.</label>
                                            <input id="euss_id" type="hidden" class="form-control input-border-bottom"  value="{{$employee->id}}"
                                                name="euss_no">
                                            <input id="euss_no" type="text" class="form-control input-border-bottom"  value="{{$employee->euss_no}}"
                                                name="euss_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom" id="euss_nation"
                                                name="euss_nation">
                                                <option value="{{$employee->euss_nation}}">{{$employee->euss_nation}}</option>
                                                <option value="">Select</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_by" class="placeholder">Issued By</label>
                                            <input id="e_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->e_issued_by}}"
                                                name="e_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_date" class="placeholder">Issued Date</label>
                                            <input id="e_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->e_issued_date}}" name="e_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="e_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->e_expiry_date}}" name="e_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="e_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->e_eligible_date}}" name="e_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="euss_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->euss_proof}}" name="euss_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            @if($employee->crn_status == 'Yes')
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_status"
                                                    value="Yes" checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_status"
                                                    value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @else
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_status"
                                                    value="Yes">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_status"
                                                    value="No"  checked="">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="euss_remarks" class="placeholder">Remarks</label>
                                            <input id="euss_remarks" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="euss_remarks">

                                        </div>
                                    </div>
                                </div>
                              
                                <h3 class="title">Disclosure and Barring Service (DBS) details</h3>
                             
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_type" class="placeholder">DBS Type </label>
                                                <select class="form-control input-border-bottom" id="dbs_type"
                                                    name="dbs_type">
                                                    <option valur="{{$employee->dbs_type}}">{{$employee->dbs_type}}</option>
                                                    <option value="Basic">Basic</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Advanced">Advanced</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_no" class="placeholder">Reference Number.</label>
                                            <input id="dbs_no" type="hidden" class="form-control input-border-bottom"  value="{{$employee->id}}"
                                                name="dbs_id">
                                            <input id="dbs_no" type="text" class="form-control input-border-bottom"  value="{{$employee->dbs_no}}"
                                                name="dbs_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="" id="dbs_nation"
                                                name="dbs_nation">
                                                <option value="{{$employee->dbs_nation}}">{{$employee->dbs_nation}}</option>
                                                <option value="">Select</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_issued_by" class="placeholder">Issued By</label>
                                            <input id="dbs_issued_by" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->dbs_issued_by}}" name="dbs_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_issued_date" class="placeholder">Issued Date</label>
                                            <input id="dbs_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->dbs_issued_date}}" name="dbs_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="dbs_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->dbs_expiry_date}}" name="dbs_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="dbs_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->dbs_eligible_date}}" name="dbs_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="dbs_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->dbs_proof}}" name="dbs_proof" id="dbs_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            @if($employee->dbs_status == 'Yes')
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="dbs_status"
                                                    value="Yes" checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="dbs_status"
                                                    value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @else
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="dbs_status"
                                                    value="Yes" >
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="dbs_status"
                                                    value="No" checked="">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dbs_remarks" class="placeholder">Remarks</label>
                                            <input id="dbs_remarks" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="dbs_remarks">

                                        </div>
                                    </div>
                                </div>
                              
                                <h3 class="title">National Id details</h3>
                                @if($employee->emp_nid)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid" class="placeholder">Reference Number.</label>
                                            <input id="nid" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_nid->id}}"
                                                name="nid_id">
                                                <input id="nid" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid}}"
                                                name="nid">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="" id="nid_nation"
                                                name="nid_nation">
                                                <option value="{{$employee->emp_nid->nid_nation}}">{{$employee->emp_nid->nid_nation}} </option>
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom" id="nid_resi"
                                                name="nid_resi">
                                                <option value="{{$employee->emp_nid->nid_resi}}">{{$employee->emp_nid->nid_resi}} </option>
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_issued_date" class="placeholder">Issued Date</label>
                                            <input id="nid_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_issued_date}}" name="nid_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="nid_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_expiry_date}}" name="nid_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="nid_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_eligible_date}}" name="nid_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="nid_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control " value="{{$employee->emp_nid->nid_proof}}" name="nid_proof" id="nid_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            @if($employee->emp_nid->nid_status == 'Yes')
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="Yes" checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @else
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="Yes" >
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="No" checked="">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nid_remarks" class="placeholder">Remarks</label>
                                            <input id="nid_remarks" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_remarks}}"
                                                name="nid_remarks">

                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid" class="placeholder">Reference Number.</label>
                                            <input id="nid" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="nid">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom" id="nid_nation"
                                                name="nid_nation">
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom" id="nid_resi"
                                                name="nid_resi">
                                                <option value="">Select </option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_issued_date" class="placeholder">Issued Date</label>
                                            <input id="nid_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="nid_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="nid_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="nid_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="nid_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="nid_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="nid_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control " name="nid_proof" id="nid_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="Yes" checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="nid_status"
                                                    value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nid_remarks" class="placeholder">Remarks</label>
                                            <input id="nid_remarks" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="nid_remarks">

                                        </div>
                                    </div>
                                </div>
                                @endif
                                <fieldset>
                                    <div class="repeater-custom-show-hide">
                                        <div data-repeater-list="other_doc">
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <h3 class="title"> Others Detail</h3>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div data-repeater-item="">
                                                @if($employee->emp_odoc)
                                                @foreach($employee->emp_odoc as $edoc)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                                Title</label>
                                                            <input id="inputFloatingLabel-jobt" type="text"
                                                                class="form-control input-border-bottom"  value="{{$edoc->o_title}}"
                                                                name="other_doc[0][o_title]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_resi" class="placeholder">Nationality
                                                            </label>
                                                            <select class="form-control input-border-bottom"
                                                                id="nid_resi" name="other_doc[0][o_nation]">
                                                                <option value="{{$edoc->o_nation}}">{{$edoc->o_nation}}</option>
                                                                <option value="">Select</option>
                                                                @foreach($countries as $cty)
                                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_issued_date" class="placeholder">Issued
                                                                Date</label>
                                                            <input id="nid_issued_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$edoc->o_issued_date}}"
                                                                name="other_doc[0][o_issued_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_expiry_date" class="placeholder">Expiry
                                                                Date</label>
                                                            <input id="nid_expiry_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$edoc->o_expiry_date}}"
                                                                name="other_doc[0][o_expiry_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_eligible_date" class="placeholder">Eligible
                                                                Review
                                                                Date</label>
                                                            <input id="nid_eligible_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$edoc->o_eligible_date}}"
                                                                name="other_doc[0][o_eligible_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="o_proof" class="placeholder">Upload
                                                                Document</label>
                                                            <input type="file" class="form-control " value="{{$edoc->o_proof}}"
                                                                name="other_doc[0][o_proof]" id="o_proof">
                                                            <small> Please select file which size up to 2mb</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <label>Is this your current status?</label><br>
                                                            @if($edoc->o_status == 'Yes')
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="Yes"
                                                                    checked="">
                                                                <span class="form-radio-sign">Yes</span>
                                                            </label>
                                                            <label class="form-radio-label ml-3">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="No">
                                                                <span class="form-radio-sign">No</span>
                                                            </label>
                                                            @else
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="Yes"
                                                                    >
                                                                <span class="form-radio-sign">Yes</span>
                                                            </label>
                                                            <label class="form-radio-label ml-3">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="No" checked="">
                                                                <span class="form-radio-sign">No</span>
                                                            </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="o_remarks" class="placeholder">Remarks</label>
                                                            <input id="o_remarks" type="text"
                                                                class="form-control input-border-bottom"  value="{{$edoc->o_remarks}}"
                                                                name="other_doc[0][o_remarks]">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"><span data-repeater-delete=""
                                                            class="btn btn-danger btn-md"><span
                                                                class="fa fa-times"></span>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <span data-repeater-create=""
                                                            class="btn btn-success btn-md"><span
                                                                class="fa fa-plus"></span></span>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                 <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                                Title</label>
                                                            <input id="inputFloatingLabel-jobt" type="text"
                                                                class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                name="other_doc[0][o_title]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="o_nation" class="placeholder">Nationality
                                                            </label>
                                                            <select class="form-control input-border-bottom"
                                                                id="o_nation" name="other_doc[0][o_nation]">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $cty)
                                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_issued_date" class="placeholder">Issued
                                                                Date</label>
                                                            <input id="nid_issued_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                name="other_doc[0][o_issued_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_expiry_date" class="placeholder">Expiry
                                                                Date</label>
                                                            <input id="nid_expiry_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                name="other_doc[0][o_expiry_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nid_eligible_date" class="placeholder">Eligible
                                                                Review
                                                                Date</label>
                                                            <input id="nid_eligible_date" type="date"
                                                                class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                name="other_doc[0][o_eligible_date]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="o_proof" class="placeholder">Upload
                                                                Document</label>
                                                            <input type="file" class="form-control "
                                                                name="other_doc[0][o_proof]" id="o_proof">
                                                            <small> Please select file which size up to 2mb</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <label>Is this your current status?</label><br>
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="Yes"
                                                                    checked="">
                                                                <span class="form-radio-sign">Yes</span>
                                                            </label>
                                                            <label class="form-radio-label ml-3">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="other_doc[0][o_status]" value="No">
                                                                <span class="form-radio-sign">No</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="o_remarks" class="placeholder">Remarks</label>
                                                            <input id="o_remarks" type="text"
                                                                class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                name="other_doc[0][o_remarks]">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"><span data-repeater-delete=""
                                                            class="btn btn-danger btn-md"><span
                                                                class="fa fa-times"></span>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <span data-repeater-create=""
                                                            class="btn btn-success btn-md"><span
                                                                class="fa fa-plus"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="date_change" class="placeholder">Changed Date</label>
													<input id="date_change" type="date" value="2021-09-01" class="form-control input-border-bottom" required="" name="date_change">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="res_remark" class="placeholder">Remarks/Restriction to work</label>
													<input id="res_remark" type="text" class="form-control input-border-bottom" name="res_remark" value="NO CHANGE">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="hr" class="placeholder">Are Sponsored migrants aware that they must inform [HR/line manager] promptly of changes in contact Details</label>
													<select id="hr" class="form-control input-border-bottom" required="" name="hr">
														<option value="">&nbsp;</option>
														<option value="Yes" selected="">Yes</option>
														<option value="No">No</option>
														<option value="N/A">N/A</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="home" class="placeholder">Are Sponsored migrants  aware that they need to cooperate Home Office interview by presenting original passports during the Interview (In applicable cases)?
													</label>
													<select id="home" class="form-control input-border-bottom" required="" name="home">
														<option value="">&nbsp;</option>
														<option value="Yes" selected="">Yes</option>
														<option value="No">No</option>
														<option value="N/A">N/A</option>
													</select>
												</div>
											</div>
										</div>
                     
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="submit" >submit</button>
                            </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                     
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->
    <script>
    function chngdepartment(empid) {

        $.ajax({
            type: 'GET',
            url: '/hrm/get_designation/' + empid,
            cache: false,
            success: function(response) {
                console.log(response);
                var obj_data = JSON.parse(response);
                var output = '';
                output += '<option value = "0"> Selected </option>';
                $.each(obj_data, function(i, data) {
                    output += '<option value = "' + data.id + '" selected> ' + data.name +
                        '</option>';
                });
                $('#designation_id').html(output);
                // document.getElementById("title").innerHTML = response;

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

    @include('layouts.footer')
    @endsection