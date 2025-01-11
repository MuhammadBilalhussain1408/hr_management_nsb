@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('jobpost-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/job_posts')}}">job_post</a></li>
                            <li class="breadcrumb-item active">Edit jobpost </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit Job post </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.job_posts.index') }}"> Back</a>
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
                        {!! Form::model($JobPost, ['method' => 'PATCH','route' => ['hrm.job_posts.update',
                        $JobPost->id]]) !!}

                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-soc-code" class="placeholder">SOC Code</label>
                                    <select id="soc" class="form-control input-border-bottom" required="" name="soc_code">
                                        <option value="{{$job->soc_code}}">{{$job->soc_code}}</option>
                                    </select>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="title" class="placeholder">Job Title</label>
                                    <select id="title" class="form-control input-border-bottom" required="" name="job_id">
                                        <option value="{{$job->id}}" selected="" disabled=""> {{$job->job_title}}</option>
                                    </select>
                                    <input value="{{$job->job_title}}" name="job_title" type="hidden" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="department" class="placeholder">Department</label>
                                    <input id="department" type="text" class="form-control input-border-bottom" required="" name="department" value="{{$job->department}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-job-details" class="placeholder">Job Code</label>
                                    <input id="inputFloatingLabel-job-details" type="text" name="job_code" value="{{$JobPost->job_code}}" class="form-control input-border-bottom" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-12">
                                <label for="job_desc" class="placeholder">Job Description</label>
                                <textarea id="job_desc" name="job_des" type="text" rows="5" class="form-control ckeditor"> {{$job->job_des}} </textarea>
                            </div>

                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-job-type" class="placeholder">Job Type</label>

                                    <select id="inputFloatingLabel-job-type" name="job_type" type="text" class="form-control input-border-bottom" required="">
                                        <option value="{{$JobPost->job_type}}">&nbsp;</option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Contractual">Contractual</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="working_hr" class="placeholder">Working Hours (Weekly)</label>
                                    <select id="working_hr" name="working_hr" class="form-control input-border-bottom" required="">
                                        <option value="{{$JobPost->working_hr}}">{{$JobPost->working_hr}}</option>
                                        @for ($x = 1; $x <= 80; $x+=.5) <option value="{{$x}}">{{$x}}</option>
                                            @endfor
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-6">
                                <label for="inputFloatingLabel-salary" class="placeholder">Job Experience</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label for="salary_min" class="placeholder">Min</label>
                                            <select id="inputFloatingLabel-selaect-salary" name="experience_min" class="form-control input-border-bottom" required="">

                                                <option value="{{$JobPost->experience_min}}" selected>{{$JobPost->experience_min}}</option>

                                                @for($x = 1; $x <= 15; $x+=1) <option value="{{$x}}">{{$x}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label for="salary_min" class="placeholder">Max</label>
                                            <select id="inputFloatingLabel-selaect-salary" name="experience_max" class="form-control input-border-bottom" required="">
                                                <option value="{{$JobPost->experience_max}}">{{$JobPost->experience_max}}</option>
                                                @for($x = 0; $x <= 50; $x+=1) <option value="{{$x}}">{{$x}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputFloatingLabel-salary" class="placeholder"> Basic Salary</label>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label for="salary_min" class="placeholder">Min</label>
                                            <input id="salary_min" type="text" class="form-control input-border-bottom" required="" name="salary_min" value="{{$JobPost->salary_min}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label for="salary_max" class="placeholder">Max</label>
                                            <input id="salary_max" type="text" class="form-control input-border-bottom" required="" name="salary_max" value="{{$JobPost->salary_max}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label for="period" class="placeholder"> Period </label>
                                            <select class="form-control input-border-bottom" id="period" required="" name="period">
                                                <option value="{{$JobPost->period}}">{{$JobPost->period}}</option>
                                                <option value="Annually">Annually</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Hourly">Hourly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-add-1" class="placeholder">Number Of Vacancies</label>
                                    <input id="inputFloatingLabel-add-1" type="number" class="form-control input-border-bottom" required="" name="no_vac" value="{{$JobPost->no_vac}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-add-2" class="placeholder">Job Location</label>
                                    <input id="inputFloatingLabel-add-2" type="text" class="form-control input-border-bottom" required="" name="job_location" value="{{$JobPost->job_location}}">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <h2 style="color:#1269db">Desired Candidate</h2>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-qualification" class="placeholder">Qualifications</label>
                                    <input id="inputFloatingLabel-qualification" type="text" class="form-control input-border-bottom" required="" name="qualification" value="{{$JobPost->qualification}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-skill-set" class="placeholder">Skill Set</label>
                                    <input id="inputFloatingLabel-skill-set" type="text" class="form-control input-border-bottom" name="skill_set" value="{{$JobPost->skill_set}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="inputFloatingLabel-age" class="placeholder">Age</label>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <select id="inputFloatingLabel-age" name="age_min" class="form-control input-border-bottom" required="">
                                                <option value="{{$JobPost->age_min}}">Min</option>
                                                <option value="{{$JobPost->age_min}}">{{$JobPost->age_min}}</option>
                                                @for($x = 15; $x <= 30; $x+=1) <option value="{{$x}}">{{$x}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <select id="inputFloatingLabel-age" name="age_max" class="form-control input-border-bottom" required="">
                                                <option value="{{$JobPost->age_max}}">Max</option>
                                                <option value="{{$JobPost->age_max}}">{{$JobPost->age_max}}</option>

                                                @for($x = 30; $x <= 80; $x+=1) <option value="{{$x}}">{{$x}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class=" form-group">
                                    <h6>Gender</h6>
                                    @if($JobPost->gender == 'Male')
                                    <input type="checkbox" id="gender" name="gender" value="Male" checked>
                                    <label for="vehicle1">Male</label>&nbsp; &nbsp; &nbsp;

                                    <input type="checkbox" id="gender" name="gender" value="Female">
                                    <label for="vehicle1">Female</label>
                                    @else
                                    <input type="checkbox" id="gender" name="gender" value="Male">
                                    <label for="vehicle1">Male</label>&nbsp; &nbsp; &nbsp;

                                    <input type="checkbox" id="gender" name="gender" value="Female" checked>
                                    <label for="vehicle1">Female</label>

                                    @endif

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-job-posting-date" class="placeholder">Job Posting
                                        Date</label>
                                    <input id="inputFloatingLabel-job-posting-date" type="date" class="form-control input-border-bottom" required="" name="posting_date" value="{{$JobPost->posting_date}}" max="2023-02-11">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-end-date" class="placeholder">Closing Date</label>
                                    <input id="inputFloatingLabel-end-date" type="date" class="form-control input-border-bottom" required="" name="closing_date" value="{{$JobPost->closing_date}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="author" class="placeholder"> Authorising Officer</label>
                                    <input id="author" type="text" class="form-control input-border-bottom" required="" name="author" value="{{$JobPost->author}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="author_desig" class="placeholder"> Authorising Officer’s Designation</label>
                                    <input id="author_desig" type="text" class="form-control input-border-bottom" required="" name="author_desig" value="{{$JobPost->author_desig}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-mail" class="placeholder"> Contact Number</label>
                                    <input id="inputFloatingLabel-mail" type="tel" class="form-control input-border-bottom" required="" name="con_num" value="{{$JobPost->con_num}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-number" class="placeholder">Email</label>
                                    <input id="inputFloatingLabel-number" type="email" class="form-control input-border-bottom" required="" name="email" value="{{$JobPost->email}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="new_role" class="placeholder">Is this a new role</label>
                                    <select class="form-control input-border-bottom" id="new_role" required="" name="new_role">
                                        <option value="{{$JobPost->new_role}}">&nbsp;</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="language_required" class="placeholder">Language Requirements
                                    </label>
                                    <select class="form-control input-border-bottom" id="language_required" name="language_required" required="" onchange="trade_epmloyee(this.value);">
                                        <option value="{{$JobPost->language_required}}">{{$JobPost->language_required}}</option>
                                        <option value="English Proficiency - Minimum of  UKVI IELTS 4 or  equivalent for international candidates only">
                                            English Proficiency - Minimum of UKVI IELTS 4 or equivalent for international
                                            candidates only</option>
                                        <option value="Not Required">Not Required</option>
                                        <option value="Others">Others</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 " id="criman_new" style="display:none;">
                                <div class="form-group">
                                    <label for="other" class="placeholder">Give Details </label>
                                    <input id="other" type="text" class="form-control input-border-bottom" name="other" value="{{$JobPost->other}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        @if($JobPost->status == 'Enable')
                                        <option value="Enable" selected="">Enable</option>
                                        <option value="Disable">Disable</option>
                                        @else
                                        <option value="Enable">Enable</option>
                                        <option value="Disable" selected="">Disable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->
    @include('layouts.footer')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    @endsection