@extends('layouts.app-wizard')
@section('content')
<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('organization-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/users')}}">Organization / Edit Organization
                                    profile</a></li>
                            <li class="breadcrumb-item active">Edit User </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Organization / Edit Organization profile </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.users.index') }}"> Back</a>
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
                        {!! Form::model($organization, ['method' => 'PATCH','route' => ['hrm.organizations.update',
                        $organization->id], 'files' => true, 'enctype' =>'multipart/form-data']) !!}

                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault01">Organization name </label><a class="badge badge-info"
                                    href="https://find-and-update.company-information.service.gov.uk/"> Info </a><span
                                    class="text-danger"> *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="company_name"
                                    value="{{$organization->company_name}}" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Type Of organization </label><span class="text-danger">
                                    *</span>
                                <input class="form-control" id="validationDefault02" name="org_type_id"
                                    value="{{$organization->org_type_id}}" readonly>

                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefaultUsername">Registration No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="validationDefaultUsername" name="reg_no"
                                        value="{{$organization->reg_no}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault01">Contact number</label><span class="text-danger">
                                    *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="phone"
                                    placeholder="First name" value="{{$organization->phone}}" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Login Email id</label><span class="text-danger">
                                    *</span>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{Auth::user()->email}}" aria-describedby="inputGroupPrepend2" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="organization_email">Organization Email Id</label><span class="text-danger">
                                    *</span>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="organization_email" name="org_email"
                                        placeholder="Email" aria-describedby="inputGroupPrepend2"
                                        value="{{$organization->org_email}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault01">Website </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="website"
                                    value="{{$organization->website}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Landing number </label><span class="text-danger">
                                    *</span>
                                <input type="numbar" class="form-control" id="validationDefault02" name="land_phone"
                                    value="{{$organization->land_phone}}">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="trad_name" class="placeholder">Trading Name <span
                                            class="star">(*)</span></label>
                                    <input id="trad_name" type="text" class="form-control input-border-bottom"
                                        readonly="" name="trad_name" value="{{$organization->trad_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputFloatingLabel9" class="placeholder">Trading Period <span
                                            class="star">(*)</span></label>

                                    <select class="form-control input-border-bottom" id="inputFloatingLabel9"
                                        readonly="" name="com_year">
                                        <option value="{{$organization->con_year}}" selected>{{$organization->con_yaer}}
                                        </option>
                                        <option value="0 to 6 months">0 to 6 months</option>
                                        <option value="Over 6 to 12 months">Over 6 to 12 months</option>
                                        <option value="Over 12 to 18 months" selected="">Over 12 to 18 months</option>
                                        <option value="Over 18 to 36 months">Over 18 to 36 months</option>
                                        <option value="Over 36 months+">Over 36 months+</option>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectFloatingLabel1" class="placeholder">Name of Sector <span
                                            class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel1"
                                        readonly="" name="sector_id">
                                        @if($organization->sector)
                                        <option value="{{$organization->sector->name}}">{{$organization->sector->name}}
                                        </option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 Other-service-activities" id="Other-service-activities"
                                style="display:none;">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel10" type="text"
                                        class="form-control input-border-bottom" name="nature_type"
                                        value="{{$organization->nature_type}}">
                                    <label for="inputFloatingLabel10" class="placeholder">Nature Type</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trad_status" class="placeholder">Have you changed Organisation /Trading
                                        name
                                        in<br> last 5 years? <span class="star">(*)</span></label>
                                    <input class="form-control input-border-bottom" id="trad_status" readonly=""
                                        name="trad_status" value="{{$organization->trad_status}}">
                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_new" style="display: block;">

                                <div class="form-group">
                                    <label for="trad_other" class="placeholder">Give Details </label>
                                    <input id="trad_other" type="text" class="form-control input-border-bottom"
                                        name="trad_other" value="{{$organization->trad_other}}" readonly>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penlty_status" class="placeholder">Did your organisation faced penalty
                                        (e.g., recruiting illegal <br> employee) in last 3 years? <span
                                            class="star">(*)</span></label>
                                    <input class="form-control input-border-bottom" id="penlty_status" readonly=""
                                        name="penlty_status" value="{{$organization->penlty_status}}">
                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_penlty_new" style="display: block;">
                                <div class="form-group">
                                    <label for="penlty_other" class="placeholder">Give Details </label>
                                    <input id="penlty_other" type="text" class="form-control input-border-bottom"
                                        name="penlty_other" value="{{$organization->penlty_other}}" readonly>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Your Logo</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="image" value="{{$organization->image}}">
                                </div>
                            </div>
                        </div>
                        <div class="row layout-top-spacing">
                            <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4>Single File Upload</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label class="custom-file-container__custom-file">
                                                <input type="file"
                                                    class="custom-file-container__custom-file__custom-file-input"
                                                    name="logo" value="{{$organization->logo}}" accept="image/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Authorised Person Details:</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="f_name" class="placeholder">First Name <span
                                            class="star">(*)</span></label>
                                    <input id="f_name" type="text" class="form-control input-border-bottom" readonly=""
                                        name="f_name" value="{{$organization->f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="l_name" class="placeholder">Last Name <span
                                            class="star">(*)</span></label>
                                    <input id="l_name" type="text" class="form-control input-border-bottom" readonly=""
                                        name="l_name" value="{{$organization->l_name}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="desig" class="placeholder">Designation <span class="star">(*)
                                        </span></label>
                                    <input id="desig" type="text" class="form-control input-border-bottom"
                                        name="designation" value="{{$organization->designation}}" readonly="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="con_num" class="placeholder">Phone No <span
                                            class="star">(*)</span></label>
                                    <input id="con_num" type="text" class="form-control input-border-bottom" readonly=""
                                        name="con_num" value="{{$organization->con_num}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authemail" class="placeholder">Email <span
                                            class="star">(*)</span></label>
                                    <input id="authemail" type="text" class="form-control input-border-bottom"
                                        readonly="" name="authemail" value="{{$organization->authemail}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="proof" value="{{$organization->proof}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_status" class="placeholder">Do you have a history of Criminal
                                        <br>conviction/Bankruptcy/Disqualification? <span
                                            class="star">(*)</span></label>
                                    <input class="form-control input-border-bottom" id="bank_status" readonly=""
                                        name="bank_status" value="{{$organization->bank_status}}">
                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_bank_new" style="display:block;">
                                <div class="form-group">

                                    <label for="bank_other" class="placeholder">Give Details </label>
                                    <input id="bank_other" type="text" class="form-control input-border-bottom"
                                        name="bank_other" value="{{$organization->bank_other}}" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Key Contact:</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="key_person" id="filladdress"
                                    value="1" checked="" readonly>
                                <span class="form-check-sign">If Same As Authorised Person</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_f_name" class="placeholder">First Name <span
                                            class="star">(*)</span></label>
                                    <input id="key_f_name" type="text" class="form-control input-border-bottom"
                                        readonly="" name="key_f_name" value="{{$organization->key_f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_f_lname" class="placeholder">Last Name <span
                                            class="star">(*)</span></label>
                                    <input id="key_f_lname" type="text" class="form-control input-border-bottom"
                                        readonly="" name="key_f_lname" value="{{$organization->key_f_lname}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_designation" class="placeholder">Designation <span class="star">(*)
                                        </span></label>
                                    <input id="key_designation" type="text" class="form-control input-border-bottom"
                                        name="key_designation" value="{{$organization->key_designation}}" readonly="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_phone" class="placeholder">Phone No <span
                                            class="star">(*)</span></label>
                                    <input id="key_phone" type="text" class="form-control input-border-bottom"
                                        readonly="" name="key_phone" value="{{$organization->key_phone}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_email" class="placeholder">Email <span
                                            class="star">(*)</span></label>
                                    <input id="key_email" type="text" class="form-control input-border-bottom"
                                        readonly="" name="key_email" value="{{$organization->key_email}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="key_proof" value="{{$organization->key_proof}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="key_bank_status" class="placeholder">Do you have a history of Criminal
                                        conviction<br>/Bankruptcy/Disqualification? <span
                                            class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="key_bank_status" readonly=""
                                        name="key_bank_status" value="{{$organization->key_bank_status}}">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="key_bank_other" >Give Details </label>
                                    <input id="key_bank_other" type="text" class="form-control"
                                        name="key_bank_other" value="{{$organization->key_bank_other}}" readonly>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Label 1 user:</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="filladdresslevel"
                                    name="level_person" value="1" checked="" readonly>
                                <span class="form-check-sign">If Same As Authorised Person</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_f_name" class="placeholder">First Name <span
                                            class="star">(*)</span></label>
                                    <input id="level_f_name" type="text" class="form-control input-border-bottom"
                                        readonly="" name="level_f_name" value="{{$organization->level_f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_f_lname" class="placeholder">Last Name <span
                                            class="star">(*)</span></label>
                                    <input id="level_f_lname" type="text" class="form-control input-border-bottom"
                                        readonly="" name="level_f_lname" value="{{$organization->level_f_lname}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_designation" class="placeholder">Designation <span
                                            class="star">(*)
                                        </span></label>
                                    <input id="level_designation" type="text" class="form-control input-border-bottom"
                                        name="level_designation" value="{{$organization->level_designation}}"
                                        readonly="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_phone" class="placeholder">Phone No <span
                                            class="star">(*)</span></label>
                                    <input id="level_phone" type="text" class="form-control input-border-bottom"
                                        readonly="" name="level_phone" value="{{$organization->level_phone}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_email" class="placeholder">Email <span
                                            class="star">(*)</span></label>
                                    <input id="level_email" type="text" class="form-control input-border-bottom"
                                        readonly="" name="level_email" value="{{$organization->level_email}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="level_proof" value="{{$organization->level_proof}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="level_bank_status" class="placeholder">Do you have a history of Criminal
                                        conviction<br>/Bankruptcy/Disqualification? <span
                                            class="star">(*)</span></label>
                                    <input class="form-control input-border-bottom" id="level_bank_status" readonly=""
                                        name="level_bank_status" value="{{$organization->level_bank_status}}">

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_level_bank_new" style="display:block;">
                                <div class="form-group">
                                    <label for="level_bank_other" class="placeholder">Give Details </label>
                                    <input id="level_bank_other" type="text" class="form-control input-border-bottom"
                                        name="level_bank_other" value="{{$organization->level_bank_other}}" readonly>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Organisation Address:</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="zip" style="width:100%" class="placeholder">Post Code </label>
                                    <input id="zip" type="text" class="form-control input-border-bottom" name="zip"
                                        onchange="getcode();" value="{{$organization->zip}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="se_add" class="placeholder">Select Address </label>
                                    <input class="form-control input-border-bottom" id="se_add" name="se_add"
                                        value="{{$organization->se_add}}" readonly>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address" class="placeholder">Address Line 1 </label>
                                    <input id="address" type="text" class="form-control input-border-bottom"
                                        name="address1" value="{{$organization->address1}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address2" class="placeholder">Address Line 2</label>
                                    <input id="address2" type="text" class="form-control input-border-bottom"
                                        name="address2" value="{{$organization->address2}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="road" class="placeholder">Address Line 3 </label>
                                    <input id="road" type="text" class="form-control input-border-bottom" name="road"
                                        value="{{$organization->road}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city" class="placeholder">City / County</label>
                                    <input id="city" type="text" class="form-control input-border-bottom" name="city"
                                        value="{{$organization->city}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="country" class="placeholder">Country </label>
                                    <input class="form-control input-border-bottom" id="country" name="country" value="{{$organization->country}}" readonly>                      
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="post_code">Post Code </label>
                                <input type="text" class="form-control" id="post_code" name="post_code"
                                    value="{{$organization->post_code}}" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="label_lname">Select Address </label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{$organization->address}}" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="address">Address Line 1</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="address" name="address1"
                                        value="{{$organization->address1}}" aria-describedby="inputGroupPrepend2" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Organisation Employee (According to latest RTI):</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                            <label for="label_fname">Full name </label><span class="text-danger"> *</span>
                            </div>
                            <div class="col-md-2">
                            <label for="label_lname">Department </label><span class="text-danger"> *</span>
                            </div>
                            <div class="col-md-2">
                            <label for="label_designation">Job Type</label>
                            </div>
                            <div class="col-md-2">
                            <label for="label_phone">Job Title </label><span class="text-danger"> *</span>
                            </div>
                            <div class="col-md-3">
                            <label for="label_email">Immigration status</label>
                            </div>
                        </div>
                        @foreach($employees as $emp)
                        <div class="form-row">
                            <div class="col-md-3 mb-4">
                                <input type="text" class="form-control" id="label_fname" name="label_fname"
                                    value="{{$emp->fname}} {{$emp->mid_name}} {{$emp->lname}}" readonly>
                            </div>
                            <div class="col-md-2 mb-4">
                               
                                <input type="text" class="form-control" id="label_lname" name="label_lname"
                                    value="{{$emp->department->name}}" readonly>
                            </div>
                            <div class="col-md-2 mb-4">
                               
                                <div class="input-group">
                                    <input type="text" class="form-control" id="label_designation"
                                        name="employee_type_id" value="{{$emp->employee_type_id}}"
                                        aria-describedby="inputGroupPrepend2" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                               
                                <input type="text" class="form-control" id="label_phone" name="label_phone"
                                    value="@if($emp->designation){{$emp->designation->name}}@endif" readonly>
                            </div>
                            <div class="col-md-3 mb-4">
                               
                                <div class="input-group">
                                    <input type="email" class="form-control" id="label_email" name="label_email"
                                        value="{{$emp->nationality}}" aria-describedby="inputGroupPrepend2" readonly>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Trading Hours:</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <label for="day2" class="placeholder">Day</label>
                            </div>
                            <div class="col-md-3">
                                <label for="mon_status" class="placeholder">Status</label>
                            </div>
                            <div class="col-md-3">
                                <label for="mon_time" class="placeholder">Opening Time</label>
                            </div>
                            <div class="col-md-3">
                                <label for="mon_close" class="placeholder">Closing Time</label>
                            </div>
                        </div>
                        @foreach($organization->trading as $tdh)
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day2" name="trading[0][day]"
                                        value="{{$tdh->day}}" readonly="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control input-border-bottom " id="mon_status"
                                        name="trading[0][day_status]" value="{{$tdh->day_status}}" readonly=""[>

                                </div>
                            </div>
                            @php
                            $periods = Carbon\CarbonPeriod::create('01:00', '30 minutes', '24:00');
                            @endphp
                            <div class="col-md-3" id="mon_status_open" style="display: block;">
                                <div class="form-group">

                                    <input class="form-control input-border-bottom " id="mon_time"
                                        name="trading[0][day_open]" value="{{$tdh->day_open}}" readonly="">
                                </div>
                            </div>

                            <div class="col-md-3" id="mon_close_open" style="display: none;">
                                <div class="form-group">
                                    <label for="" class="placeholder">Opening Time</label>
                                    <input type="text" class="form-control " id="" value="{{$tdh->day_open}}"
                                        readonly="">

                                </div>
                            </div>

                            <div class="col-md-3 " id="mon_status_close" style="display: block;">
                                <div class="form-group">
                                    <input class="form-control input-border-bottom " id="mon_close"
                                        name="trading[0][day_close]" value="{{$tdh->day_close}}" readonly>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Upload Documents:</strong> <a class="badge badge-info"
                                        href="https://find-and-update.company-information.service.gov.uk/"> Sample </a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <label for="label_fname">Type of Document </label>
                            </div>

                            @if($organization->docs)
                            @foreach($organization->docs as $ck)

                            <div class="col-md-6">

                                <span class="text-danger"> *</span>
                                <input value="{{$ck->name}}" class="form-control input-border-bottom" readonly>
                            </div>

                            <div class="col-md-6">
                                <a href="{{asset('/storage/upload/doc/'.$ck->image)}}" target="_blank"
                                    class=" btn btn-success btn-md mt-4" download="">
                                    <span class="fa fa-download"></span></a>

                            </div>
                            @endforeach
                            @endif

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>


    @endsection