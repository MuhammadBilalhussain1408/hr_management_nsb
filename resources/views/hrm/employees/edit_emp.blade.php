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
                            <li class="breadcrumb-item active">Create New Employees </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New Employees </h4>
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

                    
                        {!! Form::model($employee, ['method' => 'PATCH','route' => ['hrm.employees.update',
                        $employee->id], 'files' => true, 'enctype' =>'multipart/form-data']) !!}
                        <!-- One "tab" for each step in the form: -->
                        <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                        <div class="tab">
                            <div class="multisteps-form__content">
                                <h3> Personal Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel1" class="placeholder">First Name <span
                                                    style="color:red;">*</span></label>
                                            <input id="inputFloatingLabel1" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}" required="" name="fname">
                                            <input type="hidden" class="form-control input-border-bottom"  required="" name="organization_id" value="{{$organization}}">

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
                                <h5> Service Details</h5>
                                <hr>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="department_id" class="placeholder">Department </label>
                                            <select class="form-control input-border-bottom"  id="department_id"
                                                name="department_id" onchange="chngdepartment(this.value);">
                                                <option value="{{$employee->department->id}}">{{$employee->department->name}}</option>
                                                @foreach($departments as $dep)
                                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="designation" class="placeholder">Designation </label>
                                            <select class="form-control input-border-bottom"  id="designation_id"
                                                name="designation_id">
                                                @if($employee->designation)
                                                <option value="{{$employee->designation->id}}" selected="" disabled="">{{$employee->designation->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="inputFloatingLabel4" class="placeholder">Date of Joining
                                            </label>
                                            <input id="inputFloatingLabel4 form-date" type="date" class="form-control " value="{{$employee->join_date}}"
                                                name="join_date" max="2023-02-18">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="employee_type_id" class="placeholder">Employment Type
                                            </label>
                                            <select class="form-control input-border-bottom"  id="employee_type_id"
                                                name="employee_type_id">
                                                @if($employee->emp_type)
                                                <option value="{{$employee->emp_type->id}}" selected>{{$employee->emp_type->name}}</option>
                                               @endif
                                                @foreach($emptypes as $empt)
                                                <option value="{{$empt->id}}">{{$empt->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel6" class="placeholder">Date of
                                                Confirmation</label>
                                            <input id="inputFloatingLabel6" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->date_confirm}}" name="date_confirm">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel7" class="placeholder">Contract Start
                                                Date</label>
                                            <input id="inputFloatingLabel7" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->start_date}}" name="start_date">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel8" class="placeholder">Contract End Date
                                                (If
                                                Applicable)</label>
                                            <input id="inputFloatingLabel8" type="date"
                                                class="form-control input-border-bottom" value="{{$employee->end_date}}" name="end_date">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel10" class="placeholder">Job
                                                Location</label>
                                            <input id="inputFloatingLabel10" type="text"
                                                class="form-control input-border-bottom" value="{{$employee->job_location}}" name="job_location">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Profile Picture</label>
                                        <input type="file" name="image" id="image" onchange="Filevalidationproimge()" value="{{$employee->image}}">
                                        <small> Please select image which size up to 2mb</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectFloatingLabelra" class="placeholder">Reporting
                                                Authority</label>
                                            <select class="form-control input-border-bottom" id="selectFloatingLabelra"
                                                name="report_author">
                                                <option value="{{$employee->report_author}}" selected>{{$employee->report_author}}</option>
                                                @foreach($employees as $emp)
                                                <option value="{{$emp->fname}} {{$emp->mid_name}}
                                                    {{$emp->lname}}">{{$emp->fname}} {{$emp->mid_name}}
                                                    {{$emp->lname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectFloatingLabells" class="placeholder">Leave Sanction
                                                Authority</label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="selectFloatingLabells"
                                                name="leave_author">
                                                <option value="">&nbsp;</option>
                                                @foreach($employees as $emp)
                                                <option value="{{$emp->fname}} {{$emp->mid_name}}
                                                    {{$emp->lname}}">{{$emp->fname}} {{$emp->mid_name}}
                                                    {{$emp->lname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab">
                            <fieldset>
                                <div class="repeater-custom-show-hide">
                                    <div data-repeater-list="education">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="title">Educational Details</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div data-repeater-item="">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sl. No.</th>
                                                                    <th>Qualification</th>
                                                                    <th>Subject</th>
                                                                    <th>Institution Name</th>
                                                                    <th>Awarding Body/ University</th>
                                                                    <th>Year of Passing</th>
                                                                    <th>Percentage</th>
                                                                    <th>Grade/Division</th>
                                                                    <th>Transcript Document
                                                                    </th>
                                                                    <th>Certificate Document</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="dynamic_row">
                                                            @if($employee->empedu)
                                                                @foreach($employee->empedu as $edu)
                                                                <tr class="itemslot" id="0">
                                                                    <td>1</td>
                                                                    <td><input type="hidden" class="form-control"
                                                                            name="education[0][id]" value="{{$edu->id}}">
                                                                        <input type="text" class="form-control"
                                                                            name="education[0][qulification]" value="{{$edu->qulification}}"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][subject]" value="{{$edu->subject}}"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="eeducation[0][institute]" value="{{$edu->institute}}"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][uni]" value="{{$edu->uni}}"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][passing_year]" value="{{$edu->passing_year}}">
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][percent]" value="{{$edu->percent}}"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][grade]" value="{{$edu->grade}}"></td>
                                                                    <td><input type="file" id="doc0"
                                                                            class="form-control"
                                                                            name="education[0][doc_tran]"
                                                                            onchange="Filevalidationdocnew(0)" value="{{$edu->doc_tran}}"> <small>
                                                                            Please select
                                                                            file
                                                                            which size up to 2mb</small></td>
                                                                    <td><input type="file" id="doc20"
                                                                            class="form-control"
                                                                            name="education[0][doc_cer]" value="{{$edu->doc_cer}}"
                                                                            onchange="Filevalidationdocnewdoc(0)">
                                                                        <small> Please select
                                                                            file which size up to 2mb</small>
                                                                    </td>
                                                                    <td>
                                                                        <span data-repeater-delete=""
                                                                            class="btn btn-danger btn-md">
                                                                            <span class="fa fa-times"></span>
                                                                        </span>
                                                                        <span data-repeater-create=""
                                                                            class="btn btn-success btn-md">
                                                                            <span class="fa fa-plus"></span>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr class="itemslot" id="0">
                                                                    <td>1</td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][qulification]"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][subject]"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="eeducation[0][institute]"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][uni]"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][passing_year]">
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][percent]"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            name="education[0][grade]"></td>
                                                                    <td><input type="file" id="doc0"
                                                                            class="form-control"
                                                                            name="education[0][doc_tran]"
                                                                            onchange="Filevalidationdocnew(0)"> <small>
                                                                            Please select
                                                                            file
                                                                            which size up to 2mb</small></td>
                                                                    <td><input type="file" id="doc20"
                                                                            class="form-control"
                                                                            name="education[0][doc_cer]"
                                                                            onchange="Filevalidationdocnewdoc(0)">
                                                                        <small> Please select
                                                                            file which size up to 2mb</small>
                                                                    </td>
                                                                    <td>
                                                                        <span data-repeater-delete=""
                                                                            class="btn btn-danger btn-md">
                                                                            <span class="fa fa-times"></span>
                                                                        </span>
                                                                        <span data-repeater-create=""
                                                                            class="btn btn-success btn-md">
                                                                            <span class="fa fa-plus"></span>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="repeater-custom-show-hide">
                                    <div data-repeater-list="car">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <h3 class="title">JOb Details</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div data-repeater-item="">
                                            @if($employee->emp_jobs)
                                            @foreach($employee->emp_jobs as $job)
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                            Title</label>
                                                            <input id="inputFloatingLabel-jobt" type="hidden"
                                                            class="form-control input-border-bottom"  value="{{$job->id}}"
                                                            name="car[0][id]">
                                                        <input id="inputFloatingLabel-jobt" type="text"
                                                            class="form-control input-border-bottom"  value="{{$job->title}}"
                                                            name="car[0][title]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Start
                                                            Date</label>
                                                        <input id="inputFloatingLabel-jobs" type="date"
                                                            class="form-control input-border-bottom"  value="{{$job->start_date}}"
                                                            name="car[0][start_date]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobe" class="placeholder">End
                                                            Date
                                                        </label>
                                                        <input id="inputFloatingLabel-jobe" type="date"
                                                            class="form-control input-border-bottom"  value="{{$job->end_date}}"
                                                            name="car[0][end_date]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"><span data-repeater-delete=""
                                                        class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="selectFloatingLabelexp" class="placeholder">Year of
                                                            Experience</label>
                                                        <select class="form-control input-border-bottom"
                                                            id="selectFloatingLabelexp" name="car[0][year_exp]">
                                                            <option value="{{$job->year_exp}}">{{$job->year_exp}}</option>
                                                            @php for ($x = 0; $x <= 10; $x++) {
                                                                echo "<option>$x</option>" ; } @endphp </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Job
                                                            Description</label>
                                                        <textarea id="inputFloatingLabel-jobs" rows="5"
                                                            class="form-control"
                                                            style="height:135px !important;resize:none;"
                                                            name="car[0][description]">{{$job->description}} </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span data-repeater-create="" class="btn btn-success btn-md"><span
                                                            class="fa fa-plus"></span></span>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                            Title</label>
                                                        <input id="inputFloatingLabel-jobt" type="text"
                                                            class="form-control input-border-bottom"
                                                            name="car[0][title]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Start
                                                            Date</label>
                                                        <input id="inputFloatingLabel-jobs" type="date"
                                                            class="form-control input-border-bottom"
                                                            name="car[0][start_date]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobe" class="placeholder">End
                                                            Date
                                                        </label>
                                                        <input id="inputFloatingLabel-jobe" type="date"
                                                            class="form-control input-border-bottom"
                                                            name="car[0][end_date]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"><span data-repeater-delete=""
                                                        class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="selectFloatingLabelexp" class="placeholder">Year of
                                                            Experience</label>
                                                        <select class="form-control input-border-bottom"
                                                            id="selectFloatingLabelexp" name="car[0][year_exp]">
                                                            @php for ($x = 0; $x <= 10; $x++) {
                                                                echo "<option>$x</option>" ; } @endphp </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Job
                                                            Description</label>
                                                        <textarea id="inputFloatingLabel-jobs" rows="5"
                                                            class="form-control"
                                                            style="height:135px !important;resize:none;"
                                                            name="car[0][description]"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span data-repeater-create="" class="btn btn-success btn-md"><span
                                                            class="fa fa-plus"></span></span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <div class="tab">
                            <fieldset>
                                <div class="repeater-custom-show-hide">
                                    <div data-repeater-list="taining">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <h3 class="title"> Training Details</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div data-repeater-item="">
                                        @if($employee->emp_taining)
                                            @foreach($employee->emp_taining as $taing)
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                            Title</label>
                                                            <input id="inputFloatingLabel-jobt" type="hidden"
                                                            class="form-control input-border-bottom"  value="{{$taing->id}}"
                                                            name="taining[0][id]">
                                                        <input id="inputFloatingLabel-jobt" type="text"
                                                            class="form-control input-border-bottom"  value="{{$taing->title}}"
                                                            name="taining[0][title]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Start
                                                            Date</label>
                                                        <input id="inputFloatingLabel-jobs" type="date"
                                                            class="form-control input-border-bottom"  value="{{$taing->start_date}}"
                                                            name="taining[0][start_date]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobe" class="placeholder">End
                                                            Date
                                                        </label>
                                                        <input id="inputFloatingLabel-jobe" type="date"
                                                            class="form-control input-border-bottom"  value="{{$taing->end_date}}"
                                                            name="taining[0][end_date]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"><span data-repeater-delete=""
                                                        class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Job
                                                            Description</label>
                                                        <textarea id="inputFloatingLabel-jobs" rows="5"
                                                            class="form-control"
                                                            style="height:135px !important;resize:none;"
                                                            name="taining[0][description]">{{$taing->description}} </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span data-repeater-create="" class="btn btn-success btn-md"><span
                                                            class="fa fa-plus"></span></span>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                            Title</label>
                                                        <input id="inputFloatingLabel-jobt" type="text"
                                                            class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                            name="taining[0][title]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Start
                                                            Date</label>
                                                        <input id="inputFloatingLabel-jobs" type="date"
                                                            class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                            name="taining[0][start_date]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobe" class="placeholder">End
                                                            Date
                                                        </label>
                                                        <input id="inputFloatingLabel-jobe" type="date"
                                                            class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                            name="taining[0][end_date]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"><span data-repeater-delete=""
                                                        class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFloatingLabel-jobs" class="placeholder">Job
                                                            Description</label>
                                                        <textarea id="inputFloatingLabel-jobs" rows="5"
                                                            class="form-control"
                                                            style="height:135px !important;resize:none;"
                                                            name="taining[0][description]"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span data-repeater-create="" class="btn btn-success btn-md"><span
                                                            class="fa fa-plus"></span></span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab">
                            <h3>Emergency
                                / Next of Kin Contact Details</h3>
                            @if($employee->emp_econ)
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="emg_name" class="placeholder">Name</label>
                                        <input id="emg_name" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_econ->emg_name}}"
                                            name="emg_name">
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="relation" class="placeholder">Relationship</label>
                                        <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="relation" name="relation">
                                            <option value="{{$employee->emp_econ->relation}}" selected>{{$employee->emp_econ->relation}}</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother </option>
                                            <option value="Wife">Wife</option>
                                            <option value="Relatives">Relatives</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Partner">Partner</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Friend">Friend</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="emg_email" class="placeholder">Email</label>
                                        <input id="emg_email" type="email" class="form-control input-border-bottom"  value="{{$employee->emp_econ->emg_email}}"
                                            name="emg_email">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emg_phone" class="placeholder">Emergency Contact
                                            No.</label>
                                        <input id="emg_phone" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_econ->emgg_phone}}"
                                            name="emg_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="emg_address" class="placeholder">Address</label>
                                        <input id="emg_address" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_econ->emg_address}}"
                                            name="emg_address">
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="emg_name" class="placeholder">Name</label>
                                        <input id="emg_name" type="text" class="form-control input-border-bottom"
                                            name="emg_name">
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="relation" class="placeholder">Relationship</label>
                                        <select class="form-control input-border-bottom" id="relation" name="relation">
                                            <option value="" selected>Select</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother </option>
                                            <option value="Wife">Wife</option>
                                            <option value="Relatives">Relatives</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Partner">Partner</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Friend">Friend</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="emg_email" class="placeholder">Email</label>
                                        <input id="emg_email" type="email" class="form-control input-border-bottom"
                                            name="emg_email">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emg_phone" class="placeholder">Emergency Contact
                                            No.</label>
                                        <input id="emg_phone" type="text" class="form-control input-border-bottom" 
                                            name="emg_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="emg_address" class="placeholder">Address</label>
                                        <input id="emg_address" type="text" class="form-control input-border-bottom"  
                                            name="emg_address">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <h3>Certified Membership</h3>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="license" class="placeholder">Title of Certified
                                            License</label>
                                        <input id="license" type="text" class="form-control input-border-bottom"  value="{{$employee->license}}"
                                            name="license">
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="license_number" class="placeholder">License
                                            Number</label>
                                        <input id="license_number" type="text" class="form-control input-border-bottom"  value="{{$employee->license_number}}"
                                            name="license_number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="li_start_date" class="placeholder">Start Date</label>
                                        <input id="li_start_date" type="date" class="form-control input-border-bottom"  value="{{$employee->li_start_date}}"
                                            name="li_start_date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="li_end_date" class="placeholder">End Date</label>
                                        <input id="li_end_date" type="date" class="form-control input-border-bottom"  value="{{$employee->li_end_date}}"
                                            name="li_end_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
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
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_coninfo->country}}" name="country"
                                                id="ctyzen_country">
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
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" name="country"
                                                id="ctyzen_country">
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
                                <fieldset>
                                    <div class="repeater-custom-show-hide">
                                        <div data-repeater-list="other">
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <h3 class="title"> Others Detail</h3>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div data-repeater-item="">
                                            @if($employee->emp_odetails)
                                            @foreach($employee->emp_odetails as $eod)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                                Title</label>
                                                                <input id="inputFloatingLabel-jobt" type="hidden"
                                                                class="form-control input-border-bottom"  value="{{$eod->id}}"
                                                                name="other[0][id]">
                                                            <input id="inputFloatingLabel-jobt" type="text"
                                                                class="form-control input-border-bottom"  value="{{$eod->title}}"
                                                                name="other[0][title]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobs"
                                                                class="placeholder">Upload Document
                                                            </label>
                                                            <input id="inputFloatingLabel-jobs" type="file"
                                                                class="form-control input-border-bottom"  value="{{$eod->doc}}"
                                                                name="other[0][doc]">
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
                                                @else
                                                 <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobt" class="placeholder">Job
                                                                Title</label>
                                                            <input id="inputFloatingLabel-jobt" type="text"
                                                                class="form-control input-border-bottom"
                                                                name="other[0][title]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="inputFloatingLabel-jobs"
                                                                class="placeholder">Upload Document
                                                            </label>
                                                            <input id="inputFloatingLabel-jobs" type="file"
                                                                class="form-control input-border-bottom"
                                                                name="other[0][doc]">
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
                                                @endif
                                            </div>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="tab">
                            <h3>Passport Details</h3>
                            <div class="multisteps-form__content">
                                @if($employee->emp_passport)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_no" class="placeholder">Passport</label>
                                            <input id="passport_no" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_passport->id}}"
                                                name="passport_id">
                                            <input id="passport_no" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_passport->passport_no}}"
                                                name="passport_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="epass_nationality" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom" id="epass_nationality"
                                                name="epass_nationality">
                                                <option value="{{$employee->emp_passport->nationality}}">{{$employee->emp_passport->nationality}}</option>
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bith_place" class="placeholder">Place of Birth</label>
                                            <input id="bith_place" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_passport->bith_place}}"
                                                name="bith_place">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued By</label>
                                            <input id="issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_passport->issued_by}}"
                                                name="issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="issued_by" type="date" class="form-control input-border-bottom"  value="{{$employee->emp_passport->issued_date}}"
                                                name="issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="expiry_date" type="date" class="form-control input-border-bottom"  value="{{$employee->emp_passport->expiry_date}}"
                                                name="expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eligible_for" class="placeholder">Eligible Review Date</label>
                                            <input id="eligible_for" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_passport->eligible_for}}" name="eligible_for">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="add_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->emp_passport->pr_add_proof}}" name="pr_add_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current passport?</label><br>
                                            @if($employee->emp_passport->crn_passport == 'Yes')
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
                                                class="form-control input-border-bottom"  value="{{$employee->emp_passport->fname}}" name="passport_remarks">

                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_no" class="placeholder">Passport</label>
                                            <input id="passport_no" type="text" class="form-control input-border-bottom"
                                                name="passport_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="se_add" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom" id="epass_nationality"
                                                name="epass_nationality">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bith_place" class="placeholder">Place of Birth</label>
                                            <input id="bith_place" type="text" class="form-control input-border-bottom"
                                                name="bith_place">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued By</label>
                                            <input id="issued_by" type="text" class="form-control input-border-bottom"
                                                name="issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="issued_by" type="date" class="form-control input-border-bottom"
                                                name="issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="expiry_date" type="date" class="form-control input-border-bottom"
                                                name="expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eligible_for" class="placeholder">Eligible Review Date</label>
                                            <input id="eligible_for" type="date"
                                                class="form-control input-border-bottom" name="eligible_for">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="add_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control " name="pr_add_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current passport?</label><br>
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
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="passport_remarks" class="placeholder">Remarks</label>
                                            <input id="passport_remarks" type="text"
                                                class="form-control input-border-bottom" name="passport_remarks">

                                        </div>
                                    </div>
                                </div>
                                @endif
                                <h3> Visa / BRP Details</h3>
                                @if($employee->emp_visa)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_no" class="placeholder">Visa No</label>
                                            <input id="visa_id" type="hidden" class="form-control input-border-bottom"  value="{{$employee->emp_visa->id}}"
                                                name="visa_id">
                                            <input id="visa_no" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_visa->visa_no}}"
                                                name="visa_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_visa->visa_nation}}" id="visa_nation"
                                                name="visa_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_visa->visa_resi}}" id="visa_resi"
                                                name="visa_resi">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_issued_by" class="placeholder">Issued By</label>
                                            <input id="v_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_visa->v_issued_by}}"
                                                name="v_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="v_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_visa->v_issued_date}}" name="v_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="v_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_visa->v_expiry_date}}" name="v_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="v_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_visa->v_eligible_date}}" name="v_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vf_proof" class="placeholder">Upload Front Side Document</label>
                                            <input type="file" class="form-control" value="{{$employee->emp_visa->vf_proof}}" name="vf_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vb_proof" class="placeholder">Upload Back Side Document</label>
                                            <input type="file" class="form-control"  value="{{$employee->emp_visa->vb_proof}}" name="vb_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current visa?</label><br>
                                            @if($employee->emp_visa->crn_visa == 'Yes')
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
                                                class="form-control input-border-bottom"  value="{{$employee->emp_visa->visa_remarks}}" name="visa_remarks">

                                        </div>
                                    </div>
                                </div>
                                @else
                                  <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_no" class="placeholder">Visa No</label>
                                            <input id="visa_no" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="visa_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="visa_nation"
                                                name="visa_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="visa_resi"
                                                name="visa_resi">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_issued_by" class="placeholder">Issued By</label>
                                            <input id="v_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="v_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="issued_by" class="placeholder">Issued Date</label>
                                            <input id="v_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="v_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="v_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="v_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="v_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="v_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="v_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vf_proof" class="placeholder">Upload Front Side Document</label>
                                            <input type="file" class="form-control " name="vf_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="vb_proof" class="placeholder">Upload Back Side Document</label>
                                            <input type="file" class="form-control " name="vb_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current visa?</label><br>
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="Yes"
                                                    checked="">
                                                <span class="form-radio-sign">Yes</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="crn_visa" value="No">
                                                <span class="form-radio-sign">No</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="visa_remarks" class="placeholder">Remarks</label>
                                            <input id="visa_remarks" type="text"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="visa_remarks">

                                        </div>
                                    </div>
                                </div>
                                @endif
                                <h3 class="title"> EUSS/Time limit details </h3>
                                @if($employee->emp_euss)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_no" class="placeholder">Reference Number.</label>
                                            <input id="euss_id" type="hidden" class="form-control input-border-bottom"  value="{{$employee->emp_euss->id}}"
                                                name="euss_no">
                                            <input id="euss_no" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_euss->euss_no}}"
                                                name="euss_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_euss->euss_nation}}" id="euss_nation"
                                                name="euss_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_by" class="placeholder">Issued By</label>
                                            <input id="e_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_euss->e_issued_by}}"
                                                name="e_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_date" class="placeholder">Issued Date</label>
                                            <input id="e_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_euss->e_issued_date}}" name="e_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="e_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_euss->e_expiry_date}}" name="e_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="e_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_euss->e_eligible_date}}" name="e_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="euss_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->emp_euss->euss_proof}}" name="euss_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            @if($employee->emp_euss->crn_status == 'Yes')
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
                                @else
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_no" class="placeholder">Reference Number.</label>
                                            <input id="euss_no" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="euss_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="euss_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="euss_nation"
                                                name="euss_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_by" class="placeholder">Issued By</label>
                                            <input id="e_issued_by" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="e_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_issued_date" class="placeholder">Issued Date</label>
                                            <input id="e_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="e_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="e_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="e_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="e_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="e_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="euss_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control " name="euss_proof" id="add_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
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
                                @endif
                                <h3 class="title">Disclosure and Barring Service (DBS) details</h3>
                                @if($employee->emp_dbs)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_type" class="placeholder">DBS Type </label>
                                                <select class="form-control input-border-bottom" id="dbs_type"
                                                    name="dbs_type">
                                                    <option valur="{{$employee->emp_dbs->dbs_type}}">{{$employee->emp_dbs->dbs_type}}</option>
                                                    <option value="Basic">Basic</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Advanced">Advanced</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_no" class="placeholder">Reference Number.</label>
                                            <input id="dbs_no" type="hidden" class="form-control input-border-bottom"  value="{{$employee->emp_dbs->id}}"
                                                name="dbs_id">
                                            <input id="dbs_no" type="text" class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_no}}"
                                                name="dbs_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_nation}}" id="dbs_nation"
                                                name="dbs_nation">
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
                                                class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_issued_by}}" name="dbs_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_issued_date" class="placeholder">Issued Date</label>
                                            <input id="dbs_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_issued_date}}" name="dbs_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="dbs_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_expiry_date}}" name="dbs_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="dbs_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->emp_dbs->dbs_eligible_date}}" name="dbs_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="dbs_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control" value="{{$employee->emp_dbs->dbs_proof}}" name="dbs_proof" id="dbs_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
                                            @if($employee->emp_dbs->dbs_status == 'Yes')
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
                                @else
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_type" class="placeholder">DBS Type </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="dbs_type"
                                                name="dbs_type">
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="dbs_type"
                                                    name="dbs_type">
                                                    <option value="Basic">Basic</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Advanced">Advanced</option>
                                                </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_no" class="placeholder">Reference Number.</label>
                                            <input id="dbs_no" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                name="dbs_no">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_nation" class="placeholder">Nationality </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="dbs_nation"
                                                name="dbs_nation">
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
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="dbs_issued_by">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_issued_date" class="placeholder">Issued Date</label>
                                            <input id="dbs_issued_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="dbs_issued_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_expiry_date" class="placeholder">Expiry Date</label>
                                            <input id="dbs_expiry_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="dbs_expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dbs_eligible_date" class="placeholder">Eligible Review
                                                Date</label>
                                            <input id="dbs_eligible_date" type="date"
                                                class="form-control input-border-bottom"  value="{{$employee->fname}}" name="dbs_eligible_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="dbs_proof" class="placeholder">Upload Document</label>
                                            <input type="file" class="form-control " name="dbs_proof" id="dbs_proof">
                                            <small> Please select file which size up to 2mb</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label>Is this your current status?</label><br>
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
                                @endif
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
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_nation}}" id="nid_nation"
                                                name="nid_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->emp_nid->nid_resi}}" id="nid_resi"
                                                name="nid_resi">
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
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="nid_nation"
                                                name="nid_nation">
                                                @foreach($countries as $cty)
                                                <option value="{{$cty->name}}">{{$cty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nid_resi" class="placeholder">Country of Residence </label>
                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="nid_resi"
                                                name="nid_resi">
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
                                                            <select class="form-control input-border-bottom"  value="{{$edoc->o_nation}}"
                                                                id="nid_resi" name="other_doc[0][o_nation]">
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
                                                @else
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
                                                            <label for="nid_resi" class="placeholder">Nationality
                                                            </label>
                                                            <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                                id="nid_resi" name="other_doc[0][o_nation]">
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
                                                @endif
                                            </div>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="multisteps-form__panel rounded bg-white js-active" data-animation="scaleIn">
                                <h3 class="multisteps-form__title"
                                    style="color: #1269db;border-bottom: 1px solid #ddd;padding-bottom: 11px;">Pay
                                    Details
                                </h3>
                                <div class="multisteps-form__content">
                                    @if($employee->emp_pay)
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="emp_group_name" class="placeholder">Pay Group </label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="emp_group_name"
                                                    name="emp_group_name" onchange="paygr(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    <option value="51">TEST</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emp_pay_scale" class="placeholder">Annual Pay</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="emp_pay_scale"
                                                    name="emp_pay_scale">
                                                    <option value="">&nbsp;</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="wedges_paymode" class="placeholder">Wedges pay mode
                                                </label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="wedges_paymode"
                                                    name="wedges_paymode">
                                                    <option value="">&nbsp;</option>
                                                    <option value="10">oK</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabelpt" class="placeholder">Payment
                                                    Type</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabelpt" name="emp_payment_type"
                                                    onchange="pay_type_epmloyee(this.value);">
                                                    <option value="">&nbsp;</option>

                                                    <option value="147">Per Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="daily" class="placeholder">Basic / Daily Wedges</label>
                                                <input id="daily" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    name="daily">
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group ">
                                                <label for="min_work" class="placeholder">Min. Working Hour</label>
                                                <input id="min_work" type="text" class="form-control" name="min_work">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="min_rate" class="placeholder">Rate</label>
                                                <input id="min_rate" type="text" class="form-control " name="min_rate">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabeltc" class="placeholder">Tax
                                                    Code</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabeltc" name="tax_emp"
                                                    onchange="tax_epmloyee(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($taxes as $tax)
                                                    <option value="{{$tax->id}}">{{$tax->tax_code}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="tax_ref" class="placeholder">Tax Reference</label>
                                                <input id="tax_ref" type="text" class="form-control " name="tax_ref">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="tax_per" class="placeholder">Tax Percentage</label>
                                                <input id="tax_per" type="text" class="form-control " name="tax_per">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabepm" class="placeholder">Payment
                                                    Mode</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabepm" name="emp_pay_type">
                                                    <option value="">&nbsp;</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank">Bank</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emp_bank_name" class="placeholder">Bank Name</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" name="emp_bank_name"
                                                    id="emp_bank_name" onchange="populateBranch(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputFloatingLabelbrn" class="placeholder">Branch
                                                    Name</label>
                                                <input id="inputFloatingLabelbrn" type="text"
                                                    class="form-control input-border-bottom"  value="{{$employee->fname}}" name="bank_branch_id">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputFloatingLabelbn" class="placeholder">Account
                                                    No</label>
                                                <input id="inputFloatingLabelbn" type="text"
                                                    class="form-control input-border-bottom"  value="{{$employee->fname}}" name="emp_account_no">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="emp_sort_code" class="placeholder">Sort Code</label>
                                                <input id="emp_sort_code" type="text" class="form-control"
                                                    name="emp_sort_code">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabelpc" class="placeholder">Payment
                                                    Currency</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabelpc" name="currency">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($currency as $cry)
                                                    <option value="{{$cry->name}}">{{$cry->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="emp_group_name" class="placeholder">Pay Group </label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="emp_group_name"
                                                    name="emp_group_name" onchange="paygr(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    <option value="51">TEST</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emp_pay_scale" class="placeholder">Annual Pay</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="emp_pay_scale"
                                                    name="emp_pay_scale">
                                                    <option value="">&nbsp;</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="wedges_paymode" class="placeholder">Wedges pay mode
                                                </label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" id="wedges_paymode"
                                                    name="wedges_paymode">
                                                    <option value="">&nbsp;</option>
                                                    <option value="10">oK</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabelpt" class="placeholder">Payment
                                                    Type</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabelpt" name="emp_payment_type"
                                                    onchange="pay_type_epmloyee(this.value);">
                                                    <option value="">&nbsp;</option>

                                                    <option value="147">Per Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="daily" class="placeholder">Basic / Daily Wedges</label>
                                                <input id="daily" type="text" class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    name="daily">
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group ">
                                                <label for="min_work" class="placeholder">Min. Working Hour</label>
                                                <input id="min_work" type="text" class="form-control" name="min_work">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="min_rate" class="placeholder">Rate</label>
                                                <input id="min_rate" type="text" class="form-control " name="min_rate">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabeltc" class="placeholder">Tax
                                                    Code</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabeltc" name="tax_emp"
                                                    onchange="tax_epmloyee(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($taxes as $tax)
                                                    <option value="{{$tax->id}}">{{$tax->tax_code}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="tax_ref" class="placeholder">Tax Reference</label>
                                                <input id="tax_ref" type="text" class="form-control " name="tax_ref">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="tax_per" class="placeholder">Tax Percentage</label>
                                                <input id="tax_per" type="text" class="form-control " name="tax_per">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabepm" class="placeholder">Payment
                                                    Mode</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabepm" name="emp_pay_type">
                                                    <option value="">&nbsp;</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank">Bank</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emp_bank_name" class="placeholder">Bank Name</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}" name="emp_bank_name"
                                                    id="emp_bank_name" onchange="populateBranch(this.value);">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputFloatingLabelbrn" class="placeholder">Branch
                                                    Name</label>
                                                <input id="inputFloatingLabelbrn" type="text"
                                                    class="form-control input-border-bottom"  value="{{$employee->fname}}" name="bank_branch_id">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputFloatingLabelbn" class="placeholder">Account
                                                    No</label>
                                                <input id="inputFloatingLabelbn" type="text"
                                                    class="form-control input-border-bottom"  value="{{$employee->fname}}" name="emp_account_no">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="emp_sort_code" class="placeholder">Sort Code</label>
                                                <input id="emp_sort_code" type="text" class="form-control"
                                                    name="emp_sort_code">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="selectFloatingLabelpc" class="placeholder">Payment
                                                    Currency</label>
                                                <select class="form-control input-border-bottom"  value="{{$employee->fname}}"
                                                    id="selectFloatingLabelpc" name="currency">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($currency as $cry)
                                                    <option value="{{$cry->name}}">{{$cry->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div style="text-align: right;">
                                    <p style="color:red">(*) marked fields are mandatory fields</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="multisteps-form__panel rounded bg-white js-active" data-animation="scaleIn">
                                <h3 class="title">Pay Structure</h3>
                                <div class="multisteps-form__content">
                                    <h3 class="title">Payment (Taxable)
                                    </h3>
                                    <div class="row form-group">
                                        @foreach($taxables as $tax)
                                        <label class="col-md-3 checkbox-inline">
                                            <input type="checkbox" name="taxable_id[]" value="{{$tax->id}}"> {{$tax->name}}
                                        </label>
                                        @endforeach
                                    </div>

                                    <h3 class="title">Deduction</h3>
                                    <div class="row form-group">
                                        @foreach($diductions as $did)
                                        <label class="col-md-3 checkbox-inline">
                                            <input type="checkbox" name="diduction_id[]" value="{{$did->id}}"> {{$did->name}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
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
    <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_form_steps -->

    @include('layouts.footer')
    @endsection