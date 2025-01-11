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
                                <label for="validationDefault01">Organization name </label><a class="badge badge-info" href="https://find-and-update.company-information.service.gov.uk/"> Info </a><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="company_name" value="{{$organization->company_name}}" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Type Of organization </label><span class="text-danger">
                                    *</span>
                                <select class="custom-select" id="validationDefault02" name="org_type_id" required>
                                    @if($organization->org_type)
                                    <option value="{{$organization->org_type->org_type_id}}">
                                        {{$organization->org_type_id}}
                                    </option>
                                    @endif
                                    @foreach($org_types as $org)
                                    <option value="{{$org->name}}">{{$org->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefaultUsername">Registration No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="validationDefaultUsername" name="reg_no" value="{{$organization->reg_no}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault01">Contact number</label><span class="text-danger">
                                    *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="phone" placeholder="First name" value="{{$organization->phone}}" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Login Email id</label><span class="text-danger">
                                    *</span>
                                <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" aria-describedby="inputGroupPrepend2" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="organization_email">Organization Email Id</label><span class="text-danger">
                                    *</span>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="organization_email" name="org_email" placeholder="Email" aria-describedby="inputGroupPrepend2" value="{{$organization->org_email}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault01">Website </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="validationDefault01" name="website" value="{{$organization->website}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationDefault02">Landing number </label><span class="text-danger">
                                    *</span>
                                <input type="numbar" class="form-control" id="validationDefault02" name="land_phone" value="{{$organization->land_phone}}">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="trad_name" class="placeholder">Trading Name <span class="star">(*)</span></label>
                                    <input id="trad_name" type="text" class="form-control input-border-bottom" required="" name="trad_name" value="{{$organization->trad_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputFloatingLabel9" class="placeholder">Trading Period <span class="star">(*)</span></label>

                                    <select class="form-control input-border-bottom" id="inputFloatingLabel9" required="" name="com_year">
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
                                    <label for="selectFloatingLabel1" class="placeholder">Name of Sector <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel1" required="" name="sector_id">
                                        <option value="{{$organization->sector_id}}">{{$organization->sector_id}}
                                        </option>
                                        @foreach($sectors as $sec)
                                        <option value="{{$sec->id}}" selected="">
                                            {{$sec->name}}
                                        </option>
                                        @endforeach
                                        <!-- <option value="Activities of extraterritorial organisations and bodies">
                                            Activities
                                            of extraterritorial organisations and bodies</option>
                                        <option
                                            value="Activities of households as employers; undifferentiated goods- and services- producing activities of households for own use">
                                            Activities of households as employers; undifferentiated goods- and services-
                                            producing activities of households for own use</option>
                                        <option value="Administrative and Support Service Activities">Administrative and
                                            Support Service Activities</option>
                                        <option value="Agriculture, Forestry and Fishing">Agriculture, Forestry and
                                            Fishing
                                        </option>
                                        <option value="Arts, Entertainment and Recreation">Arts, Entertainment and
                                            Recreation</option>
                                        <option value="Construction">Construction</option>
                                        <option value="Education">Education</option>
                                        <option value="Electricity, Gas, Steam and Air Conditioning Supply">Electricity,
                                            Gas, Steam and Air Conditioning Supply</option>
                                        <option value="Financial and Insurance Activities">Financial and Insurance
                                            Activities</option>
                                        <option value="Human Health and Social Work Activities">Human Health and Social
                                            Work
                                            Activities</option>
                                        <option value="Information and Communication">Information and Communication
                                        </option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Mining and Quarrying">Mining and Quarrying</option>
                                        <option value="Other service activities">Other service activities</option>
                                        <option value="Professional, Scientific and Technical Activities">Professional,
                                            Scientific and Technical Activities</option>
                                        <option value="Public Administration and Defence; Compulsory social security">
                                            Public
                                            Administration and Defence; Compulsory social security</option>
                                        <option value="Real Estate Activities">Real Estate Activities</option>
                                        <option value="Transportation and Storage">Transportation and Storage</option>
                                        <option
                                            value="Water supply, sewerage, waste management and remediation activities">
                                            Water supply, sewerage, waste management and remediation activities</option>
                                        <option
                                            value="Wholesale and Retail trade; Repair of motor vehicles and Motorcycles">
                                            Wholesale and Retail trade; Repair of motor vehicles and Motorcycles
                                        </option> -->

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 Other-service-activities" id="Other-service-activities" style="display:none;">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel10" type="text" class="form-control input-border-bottom" name="nature_type" value="{{$organization->nature_type}}">
                                    <label for="inputFloatingLabel10" class="placeholder">Nature Type</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trad_status" class="placeholder">Have you changed Organisation /Trading
                                        name
                                        in<br> last 5 years? <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="trad_status" required="" name="trad_status" onchange="trade_epmloyee(this.value);">&gt;
                                        <option value="{{$organization->trad_status}}">{{$organization->trad_status}}
                                        </option>

                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="">No</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_new" style="display: block;">

                                <div class="form-group">
                                    <label for="trad_other" class="placeholder">Give Details </label>
                                    <input id="trad_other" type="text" class="form-control input-border-bottom" name="trad_other" value="{{$organization->trad_other}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penlty_status" class="placeholder">Did your organisation faced penalty
                                        (e.g., recruiting illegal <br> employee) in last 3 years? <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="penlty_status" required="" name="penlty_status" onchange="penlty_epmloyee(this.value);">&gt;
                                        <option value="{{$organization->penlty_status}}">
                                            {{$organization->penlty_status}}
                                        </option>

                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="">No</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_penlty_new" style="display: block;">
                                <div class="form-group">
                                    <label for="penlty_other" class="placeholder">Give Details </label>
                                    <input id="penlty_other" type="text" class="form-control input-border-bottom" name="penlty_other" value="{{$organization->penlty_other}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Your Logo</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" value="{{$organization->image}}">
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
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" name="logo" value="{{$organization->logo}}" accept="image/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
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
                                    <label for="f_name" class="placeholder">First Name <span class="star">(*)</span></label>
                                    <input id="f_name" type="text" class="form-control input-border-bottom" required="" name="f_name" value="{{$organization->f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="l_name" class="placeholder">Last Name <span class="star">(*)</span></label>
                                    <input id="l_name" type="text" class="form-control input-border-bottom" required="" name="l_name" value="{{$organization->l_name}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="desig" class="placeholder">Designation <span class="star">(*)
                                        </span></label>
                                    <input id="desig" type="text" class="form-control input-border-bottom" name="designation" value="{{$organization->designation}}" required="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="con_num" class="placeholder">Phone No <span class="star">(*)</span></label>
                                    <input id="con_num" type="text" class="form-control input-border-bottom" required="" name="con_num" value="{{$organization->con_num}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authemail" class="placeholder">Email <span class="star">(*)</span></label>
                                    <input id="authemail" type="text" class="form-control input-border-bottom" required="" name="authemail" value="{{$organization->authemail}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="proof" value="{{$organization->proof}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_status" class="placeholder">Do you have a history of Criminal
                                        <br>conviction/Bankruptcy/Disqualification? <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="bank_status" required="" name="bank_status" onchange="bank_epmloyee(this.value);">&gt;
                                        <option value="{{$organization->bank_status}}">{{$organization->bank_status}}
                                        </option>

                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="">No</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_bank_new" style="display:none;">
                                <div class="form-group">

                                    <label for="bank_other" class="placeholder">Give Details </label>
                                    <input id="bank_other" type="text" class="form-control input-border-bottom" name="bank_other" value="{{$organization->bank_other}}">

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
                                <input class="form-check-input" type="checkbox" name="key_person" id="filladdress" value="1" checked="">
                                <span class="form-check-sign">If Same As Authorised Person</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_f_name" class="placeholder">First Name <span class="star">(*)</span></label>
                                    <input id="key_f_name" type="text" class="form-control input-border-bottom" required="" name="key_f_name" value="{{$organization->key_f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_f_lname" class="placeholder">Last Name <span class="star">(*)</span></label>
                                    <input id="key_f_lname" type="text" class="form-control input-border-bottom" required="" name="key_f_lname" value="{{$organization->key_f_lname}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_designation" class="placeholder">Designation <span class="star">(*)
                                        </span></label>
                                    <input id="key_designation" type="text" class="form-control input-border-bottom" name="key_designation" value="{{$organization->key_designation}}" required="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_phone" class="placeholder">Phone No <span class="star">(*)</span></label>
                                    <input id="key_phone" type="text" class="form-control input-border-bottom" required="" name="key_phone" value="{{$organization->key_phone}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key_email" class="placeholder">Email <span class="star">(*)</span></label>
                                    <input id="key_email" type="text" class="form-control input-border-bottom" required="" name="key_email" value="{{$organization->key_email}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="key_proof" value="{{$organization->key_proof}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="key_bank_status" class="placeholder">Do you have a history of Criminal
                                        conviction<br>/Bankruptcy/Disqualification? <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="key_bank_status" required="" name="key_bank_status" onchange="key_bank_epmloyee(this.value);">&gt;
                                        <option value="{{$organization->key_bank_status}}">
                                            {{$organization->key_bank_status}}
                                        </option>

                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="">No</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_key_bank_new" style="display:none;">
                                <div class="form-group">
                                    <label for="key_bank_other" class="placeholder">Give Details </label>
                                    <input id="key_bank_other" type="text" class="form-control input-border-bottom" name="key_bank_other" value="{{$organization->key_bank_other}}">

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
                                <input class="form-check-input" type="checkbox" id="filladdresslevel" name="level_person" value="1" checked="">
                                <span class="form-check-sign">If Same As Authorised Person</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_f_name" class="placeholder">First Name <span class="star">(*)</span></label>
                                    <input id="level_f_name" type="text" class="form-control input-border-bottom" required="" name="level_f_name" value="{{$organization->level_f_name}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_f_lname" class="placeholder">Last Name <span class="star">(*)</span></label>
                                    <input id="level_f_lname" type="text" class="form-control input-border-bottom" required="" name="level_f_lname" value="{{$organization->level_f_lname}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_designation" class="placeholder">Designation <span class="star">(*)
                                        </span></label>
                                    <input id="level_designation" type="text" class="form-control input-border-bottom" name="level_designation" value="{{$organization->level_designation}}" required="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_phone" class="placeholder">Phone No <span class="star">(*)</span></label>
                                    <input id="level_phone" type="text" class="form-control input-border-bottom" required="" name="level_phone" value="{{$organization->level_phone}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="level_email" class="placeholder">Email <span class="star">(*)</span></label>
                                    <input id="level_email" type="text" class="form-control input-border-bottom" required="" name="level_email" value="{{$organization->level_email}}">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Proof Of Id</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="level_proof" value="{{$organization->level_proof}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="level_bank_status" class="placeholder">Do you have a history of Criminal
                                        conviction<br>/Bankruptcy/Disqualification? <span class="star">(*)</span></label>
                                    <select class="form-control input-border-bottom" id="level_bank_status" required="" name="level_bank_status" onchange="level_bank_epmloyee(this.value);">&gt;
                                        <option value="">{{$organization->level_bank_status}}</option>

                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="">No</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 " id="criman_level_bank_new" style="display:none;">
                                <div class="form-group">
                                    <label for="level_bank_other" class="placeholder">Give Details </label>
                                    <input id="level_bank_other" type="text" class="form-control input-border-bottom" name="level_bank_other" value="{{$organization->level_bank_other}}">

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
                                    <input id="zip" type="text" class="form-control input-border-bottom" name="zip" onchange="getcode();" value="{{$organization->zip}}">
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="se_add" class="placeholder">Select Address </label>
                                    <select class="form-control input-border-bottom" id="se_add" name="se_add" onchange="countryfunjj(this.value);">
                                        <option value="{{$organization->se_add}}">{{$organization->se_add}}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address" class="placeholder">Address Line 1 </label>
                                    <input id="address" type="text" class="form-control input-border-bottom" name="address1" value="{{$organization->address1}}">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address2" class="placeholder">Address Line 2</label>
                                    <input id="address2" type="text" class="form-control input-border-bottom" name="address2" value="{{$organization->address2}}">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="road" class="placeholder">Address Line 3 </label>
                                    <input id="road" type="text" class="form-control input-border-bottom" name="road" value="{{$organization->road}}">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city" class="placeholder">City / County</label>
                                    <input id="city" type="text" class="form-control input-border-bottom" name="city" value="{{$organization->city}}">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="country" class="placeholder">Country </label>
                                    <select class="form-control input-border-bottom" id="country" name="country" onchange="countryfun(this.value);">
                                    <option value="{{$organization->country}}">{{$organization->country}}</option>   
                                        @foreach($countries as $cty)
                                        <option value="{{$cty->name}}">{{$cty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="post_code">Post Code </label>
                                <input type="text" class="form-control" id="post_code" name="post_code" value="{{$organization->post_code}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="label_lname">Select Address </label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$organization->address}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="address">Address Line 1</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="address" name="address1" value="{{$organization->address1}}" aria-describedby="inputGroupPrepend2">
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Organisation Employee (According to latest RTI):</strong>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        @foreach($employees as $emp)
                        <div class="form-row">
                            <div class="col-md-3 mb-4">
                                <label for="label_fname">Full name </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="label_fname" name="label_fname" value="{{$emp->fname}} {{$emp->mid_name}} {{$emp->lname}}" readonly>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="label_lname">Department </label><span class="text-danger"> *</span>
                                @if($emp->department)
                                <input type="text" class="form-control" id="label_lname" name="label_lname" value="{{$emp->department->name}}" readonly>
                                @else
                                <input type="text" class="form-control" id="label_lname" name="label_lname" value="" readonly>
                                @endif
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="label_designation">Job Type</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="label_designation" name="employee_type_id" value="{{$emp->employee_type_id}}" aria-describedby="inputGroupPrepend2" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="label_phone">Job Title </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="label_phone" name="label_phone" value="@if($emp->designation){{$emp->designation->name}}@endif" readonly>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="label_email">Immigration status</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="label_email" name="label_email" value="{{$emp->nationality}}" aria-describedby="inputGroupPrepend2" readonly>
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
                                <div class="form-group">
                                    <label for="day2" class="placeholder">Day</label>
                                    <input type="text" class="form-control " id="day2" name="trading[0][day]" value="Monday" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="mon_status" class="placeholder">Status</label>
                                    <select class="form-control input-border-bottom " id="mon_status" name="trading[0][day_status]" onchange="monst(this.value);">
                                        @if(!empty($organization->trading[0]['day_status']))
                                        <option value="{{$organization->trading[0]['day_status']}}" selected="">{{$organization->trading[0]['day_status']}}</option>
                                        @endif
                                        <option value="Open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            @php
                            $periods = Carbon\CarbonPeriod::create('01:00', '30 minutes', '24:00');
                            @endphp
                            <div class="col-md-3" id="mon_status_open" style="display: block;">
                                <div class="form-group">
                                    <label for="mon_time" class="placeholder">Opening Time</label>
                                    <select class="form-control input-border-bottom " id="mon_time" name="trading[0][day_open]">
                                         @if(!empty($organization->trading[0]['day_open']))
                                        <option value="{{$organization->trading[0]['day_open']}}" selected="">{{$organization->trading[0]['day_open']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty
                                       @endforelse
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3" id="mon_close_open" style="display: none;">
                                <div class="form-group">

                                    <label for="" class="placeholder">Opening Time</label>
                                    <input type="text" class="form-control " id="" value="closed" readonly="">

                                </div>
                            </div>

                            <div class="col-md-3 " id="mon_status_close" style="display: block;">
                                <div class="form-group">
                                    <label for="mon_close" class="placeholder">Closing Time</label>
                                    <select class="form-control input-border-bottom " id="mon_close" name="trading[0][day_close]">
                                         @if(!empty($organization->trading[0]['day_close']))
                                        <option value="{{$organization->trading[0]['day_close']}}" selected="">{{$organization->trading[0]['day_close']}}</option>
                                        @endif
                                        @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="mon_close_close" style="display: none;">
                                <div class="form-group">

                                    <label for="" class="placeholder">Closing Time</label>
                                    <input type="text" class="form-control " id="" value="closed" readonly="">

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day3" value="Tuesday" name="trading[1][day]" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="tue_status" name="trading[1][day_status]" onchange="tuest(this.value);">
                                         @if(!empty($organization->trading[0]['day_status']))
                                        <option value="{{$organization->trading[0]['day_status']}}" selected="">{{$organization->trading[0]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="tue_status_open" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="tue_time" name="trading[1][day_open]">
                                         @if(!empty($organization->trading[0]['day_open']))
                                        <option value="{{$organization->trading[0]['day_open']}}" selected="">{{$organization->trading[0]['day_open']}}</option>
                                        @endif
                                        @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="tue_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 " id="tue_status_close" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="tue_close" name="trading[1][day_close]">
                                         @if(!empty($organization->trading[0]['day_close']))
                                        <option value="{{$organization->trading[0]['day_close']}}" selected="">{{$organization->trading[0]['day_close']}}</option>
                                        @endif
                                        @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="tue_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day3" value="Wednesday" readonly="" name="trading[2][day]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="wed_status" name="trading[2][day_status]" onchange="wedst(this.value);">
                                         @if(!empty($organization->trading[0]['day_status']))
                                        <option value="{{$organization->trading[0]['day_status']}}" selected="">{{$organization->trading[0]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="wed_status_open" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="wed_time" name="trading[2][day_open]">
                                         @if(!empty($organization->trading[2]['day_open']))
                                        <option value="{{$organization->trading[2]['day_open']}}" selected="">{{$organization->trading[2]['day_open']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="wed_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 " id="wed_status_close" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="wed_close" name="trading[2][day_close]">
                                         @if(!empty($organization->trading[2]['day_close']))
                                        <option value="{{$organization->trading[2]['day_close']}}" selected="">{{$organization->trading[2]['day_close']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="wed_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day3" value="Thursday" name="trading[3][day]" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="thu_status" name="trading[3][day_status]" onchange="thust(this.value);">
                                         @if(!empty($organization->trading[3]['day_status']))
                                        <option value="{{$organization->trading[3]['day_status']}}" selected="">{{$organization->trading[3]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="thu_status_open" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="thu_time" name="trading[3][day_open]">
                                         @if(!empty($organization->trading[3]['day_open']))
                                        <option value="{{$organization->trading[3]['day_open']}}" selected="">{{$organization->trading[3]['day_open']}}</option>
                                        @endif
                                      @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="thu_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 " id="thu_status_close" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="thu_close" name="trading[3][day_close]">
                                         @if(!empty($organization->trading[3]['day_close']))
                                        <option value="{{$organization->trading[3]['day_close']}}" selected="">{{$organization->trading[3]['day_close']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="thu_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day3" value="Friday" name="trading[4][day]" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="fri_status" name="trading[4][day_status]" onchange="frist(this.value);">
                                         @if(!empty($organization->trading[4]['day_status']))
                                        <option value="{{$organization->trading[4]['day_status']}}" selected="">{{$organization->trading[4]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="fri_status_open" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="fri_time" name="trading[4][day_open]">
                                         @if(!empty($organization->trading[4]['day_open']))
                                        <option value="{{$organization->trading[4]['day_open']}}" selected="">{{$organization->trading[4]['day_open']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty
                                       @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="fri_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 " id="fri_status_close" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="fri_close" name="trading[4][day_close]">
                                         @if(!empty($organization->trading[4]['day_close']))
                                        <option value="{{$organization->trading[4]['day_close']}}" selected="">{{$organization->trading[4]['day_close']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty
                                       @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="fri_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day3" value="Saturday" name="trading[5][day]" readonly="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="sat_status" name="trading[5][day_status]" onchange="satst(this.value);">
                                         @if(!empty($organization->trading[5]['day_status']))
                                        <option value="{{$organization->trading[5]['day_status']}}" selected="">{{$organization->trading[5]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="sat_status_open" style="display: block;">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom " id="sat_time" name="trading[5][day_open]">
                                         @if(!empty($organization->trading[5]['day_open']))
                                        <option value="{{$organization->trading[5]['day_open']}}" selected="">{{$organization->trading[5]['day_open']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty
                                       @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="sat_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 " id="sat_status_close" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="sat_close" name="trading[5][day_close]">
                                         @if(!empty($organization->trading[5]['day_close']))
                                        <option value="{{$organization->trading[5]['day_close']}}" selected="">{{$organization->trading[5]['day_close']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty
                                       @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="sat_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="day1" value="Sunday" name="trading[6][day]" readonly="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="sun_status" name="trading[6][day_status]" onchange="sunst(this.value);">
                                         @if(!empty($organization->trading[6]['day_status']))
                                        <option value="{{$organization->trading[6]['day_status']}}" selected="">{{$organization->trading[6]['day_status']}}</option>
                                        @endif
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="sun_status_open" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="sun_time" name="trading[6][day_open]">
                                         @if(!empty($organization->trading[6]['day_open']))
                                        <option value="{{$organization->trading[6]['day_open']}}" selected="">{{$organization->trading[6]['day_open']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                        @empty
                                        @endforelse
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3" id="sun_close_open" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">
                                </div>
                            </div>

                            <div class="col-md-3 " id="sun_status_close" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control input-border-bottom " id="sun_close" name="trading[6][day_close]">
                                         @if(!empty($organization->trading[6]['day_status']))
                                        <option value="{{$organization->trading[6]['day_status']}}" selected="">{{$organization->trading[6]['day_status']}}</option>
                                        @endif
                                       @forelse ($periods as $time)
                                        <option value="{{$time->format('H:i')}}">{{$time->format('H:i')}}</option>
                                       @empty 
                                       @endforelse
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3" id="sun_close_close" style="display:none;">
                                <div class="form-group">
                                    <input type="text" class="form-control " id="" value="closed" readonly="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Upload Documents:</strong> <a class="badge badge-info" href="https://find-and-update.company-information.service.gov.uk/"> Sample </a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($organization->docs)
                            @foreach($organization->docs as $ck)
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="label_fname">Type of Document </label>
                                    <span class="text-danger"> *</span>

                                    <input value="{{$ck->name}}" class="form-control input-border-bottom">{{$ck->name}}
                                    </option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputFloatingLabel-jobs" class="placeholder">
                                        Proof of ID Card
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image" value="{{$ck->image}}">
                                </div>
                                <div class="col-md-4">
                                    <a href="{{asset('/storage/upload/doc/'.$ck->image)}}" target="_blank" class=" btn btn-success btn-md mt-4" download="">
                                        <span class="fa fa-download"></span></a>
                                    @can('document-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['documents.destroy',
                                    $ck->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                            @endif

                            <fieldset>
                                <div class="repeater-custom-show-hide">

                                    <div data-repeater-list="checklist">
                                        <div data-repeater-item="">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="label_fname">Type of Document </label>
                                                    <span class="text-danger"> *</span>
                                                    <select class="form-control input-border-bottom" id="doc_type_1388" name="checklist[0][name]" onchange="checktype('1388');">
                                                        <option value="" selected="">Select</option>
                                                        @foreach($checklists as $chk)
                                                        <option value="{{$chk->name}}">
                                                            {{$chk->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">
                                                            Proof of ID Card
                                                        </label>
                                                        <input id="inputFloatingLabel-jobs" type="file" class="form-control input-border-bottom" name="checklist[0][image]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1 mt-4"><span data-repeater-delete="" class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                    </span>
                                                </div>
                                                <div class="col-md-1 mt-4">
                                                    <span data-repeater-create="" class="btn btn-success btn-md"><span class="fa fa-plus"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
    @include('layouts.footer')
    <script type="text/javascript">
        function checktype(id) {
            // alert(id);
            var dtype = $("#doc_type_" + id).val();
            if (dtype == 'Others Document') {

                $("#other_doc_" + id).show();
                $("#other_doc_input_" + id).prop('disabled', false);


            } else {

                $("#other_doc_" + id).hide();
                $("#other_doc_" + id).val('');

            }
        }


        function checkdoctype(rid) {
            //alert(rid);
            var dtype1 = $("#d_type" + rid).val();
            if (dtype1 == 'Others Document') {

                $("#other_doc" + rid).show();

            } else {
                $("#other_doc" + rid).val('');
                $("#other_doc" + rid).hide();

            }
        }

        function checkfor1sttime() {
            var dtype2 = $(".checkfor1sttime").val();
            if (dtype3 == 'Others Document') {

                $("#noalreadydoc").show();

            } else {
                $("#noalreadydoc").val('');
                $("#noalreadydoc").hide();

            }
        }






        function sunst(val) {

            if (val == 'open') {

                $("#sun_status_open").show();
                $("#sun_status_close").show();
                $("#sun_close_open").hide();
                $("#sun_close_close").hide();
            } else {
                $("#sun_time").val('');
                $("#sun_status_open").hide();
                $("#sun_close").val('');
                $("#sun_status_close").hide();
                $("#sun_close_open").show();
                $("#sun_close_close").show();

            }
        }

        function monst(val) {

            if (val == 'open') {

                $("#mon_status_open").show();
                $("#mon_status_close").show();
                $("#mon_close_open").hide();
                $("#mon_close_close").hide();
            } else {
                $("#mon_time").val('');
                $("#mon_status_open").hide();
                $("#mon_close").val('');
                $("#mon_status_close").hide();
                $("#mon_close_open").show();
                $("#mon_close_close").show();
            }
        }

        function tuest(val) {

            if (val == 'open') {

                $("#tue_status_open").show();
                $("#tue_status_close").show();
                $("#tue_close_open").hide();
                $("#tue_close_close").hide();
            } else {
                $("#tue_time").val('');
                $("#tue_status_open").hide();
                $("#tue_close").val('');
                $("#tue_status_close").hide();
                $("#tue_close_open").show();
                $("#tue_close_close").show();

            }
        }

        function wedst(val) {

            if (val == 'open') {

                $("#wed_status_open").show();
                $("#wed_status_close").show();
                $("#wed_close_open").hide();
                $("#wed_close_close").hide();
            } else {
                $("#wed_time").val('');
                $("#wed_status_open").hide();
                $("#wed_close").val('');
                $("#wed_status_close").hide();
                $("#wed_close_open").show();
                $("#wed_close_close").show();

            }
        }

        function thust(val) {

            if (val == 'open') {

                $("#thu_status_open").show();
                $("#thu_status_close").show();
                $("#thu_close_open").hide();
                $("#thu_close_close").hide();
            } else {
                $("#thu_time").val('');
                $("#thu_status_open").hide();
                $("#thu_close").val('');
                $("#thu_status_close").hide();
                $("#thu_close_open").show();
                $("#thu_close_close").show();

            }
        }



        function frist(val) {

            if (val == 'open') {

                $("#fri_status_open").show();
                $("#fri_status_close").show();
                $("#fri_close_open").hide();
                $("#fri_close_close").hide();
            } else {
                $("#fri_time").val('');
                $("#fri_status_open").hide();
                $("#fri_close").val('');
                $("#fri_status_close").hide();
                $("#fri_close_open").show();
                $("#fri_close_close").show();

            }
        }

        function satst(val) {

            if (val == 'open') {

                $("#sat_status_open").show();
                $("#sat_status_close").show();
                $("#sat_close_open").hide();
                $("#sat_close_close").hide();
            } else {
                $("#sat_time").val('');
                $("#sat_status_open").hide();
                $("#sat_close").val('');
                $("#sat_status_close").hide();
                $("#sat_close_open").show();
                $("#sat_close_close").show();

            }
        }


        Filevalidation = (val) => {
            const fi = document.getElementById('docu_nat_' + val);
            // Check if any file is selected.

            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file <= 2048) {

                    } else {
                        alert(
                            "File is too Big, please select a file up to 2mb");
                        $("#docu_nat_" + val).val('');
                    }
                }
            }
        }

        Filevalidationnew = (val) => {
            const fi = document.getElementById('docu_nat_new_' + val);
            // Check if any file is selected.

            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file <= 2048) {

                    } else {
                        alert(
                            "File is too Big, please select a file up to 2mb");
                        $("#docu_nat_new_" + val).val('');
                    }
                }
            }
        }

        function trade_epmloyee(val) {
            if (val == 'Yes') {
                document.getElementById("criman_new").style.display = "block";
            } else {
                document.getElementById("criman_new").style.display = "none";
            }

        }

        function penlty_epmloyee(val) {
            if (val == 'Yes') {
                document.getElementById("criman_penlty_new").style.display = "block";
            } else {
                document.getElementById("criman_penlty_new").style.display = "none";
            }

        }

        function bank_epmloyee(val) {
            if (val == 'Yes') {
                document.getElementById("criman_bank_new").style.display = "block";
            } else {
                document.getElementById("criman_bank_new").style.display = "none";
            }

        }

        function key_bank_epmloyee(val) {
            if (val == 'Yes') {
                document.getElementById("criman_key_bank_new").style.display = "block";
            } else {
                document.getElementById("criman_key_bank_new").style.display = "none";
            }

        }
        $(document).ready(function() {
            $("#filladdress").on("click", function() {
                if (this.checked) {

                    var ceck = $("#bank_status").val();
                    $("#key_f_name").val($("#f_name").val());
                    $("#key_f_lname").val($("#l_name").val());

                    $("#key_designation").val($("#desig").val());
                    $("#key_phone").val($("#con_num").val());
                    $("#key_email").val($("#authemail").val());
                    $("#key_bank_status").val($("#bank_status").val());
                    if (ceck == 'Yes') {

                        document.getElementById("criman_key_bank_new").style.display = "block";
                        $("#key_bank_other").val($("#bank_other").val());
                    } else {
                        document.getElementById("criman_key_bank_new").style.display = "none";
                    }


                } else {
                    var ceck = $("#bank_status").val();
                    $("#key_f_name").val('');
                    $("#key_f_lname").val('');

                    $("#key_designation").val('');
                    $("#key_phone").val('');
                    $("#key_email").val('');
                    $("#key_bank_status").val('');


                    document.getElementById("criman_key_bank_new").style.display = "none";
                    $("#key_bank_other").val('');


                }
            });

            /*$(document).on('change','#emp_bank_name', function(e){
            	var ifsccode = $('#emp_bank_name option:selected').data('ifsccode');
            	$('#emp_ifsc_code').val(ifsccode);

            });*/
        });


        function level_bank_epmloyee(val) {
            if (val == 'Yes') {
                document.getElementById("criman_level_bank_new").style.display = "block";
            } else {
                document.getElementById("criman_level_bank_new").style.display = "none";
            }

        }
        $(document).ready(function() {
            $("#filladdresslevel").on("click", function() {
                if (this.checked) {

                    var ceck = $("#bank_status").val();
                    $("#level_f_name").val($("#f_name").val());
                    $("#level_f_lname").val($("#l_name").val());

                    $("#level_designation").val($("#desig").val());
                    $("#level_phone").val($("#con_num").val());
                    $("#level_email").val($("#authemail").val());
                    $("#level_bank_status").val($("#bank_status").val());
                    if (ceck == 'Yes') {

                        document.getElementById("criman_level_bank_new").style.display = "block";
                        $("#level_bank_other").val($("#bank_other").val());
                    } else {
                        document.getElementById("criman_level_bank_new").style.display = "none";
                    }


                } else {
                    var ceck = $("#bank_status").val();
                    $("#level_f_name").val('');
                    $("#level_f_lname").val('');

                    $("#level_designation").val('');
                    $("#level_phone").val('');
                    $("#level_email").val('');
                    $("#level_bank_status").val('');


                    document.getElementById("criman_level_bank_new").style.display = "none";
                    $("#level_bank_other").val('');


                }
            });

        });
    </script>
    <script>
        function getcode() {

            var getaddres = $("#zip").val();
            $.ajax({
                type: 'GET',
                url: '/' + getaddres,
                cache: false,
                success: function(response) {

                    $("#se_add").html(response);

                }
            });

        }

        function countryfunjj(value) {


            $.ajax({
                type: 'GET',
                url: '/' + value,
                cache: false,
                success: function(response) {
                    console.log(response);
                    var obj = jQuery.parseJSON(response);
                    console.log(obj);


                    $("#country").val(obj.country);
                    $("#address").val(obj.address);
                    $("#address2").val(obj.address2);
                    $("#road").val(obj.road);
                    $("#city").val(obj.city);
                }
            });

        }

        function validateForm() {
            if ($("#verified_on").val() == "" && $("#verify").val() == "approved") {
                alert("Verification date required.");
                return false;
            }
            return true;

        }
    </script>
    @endsection