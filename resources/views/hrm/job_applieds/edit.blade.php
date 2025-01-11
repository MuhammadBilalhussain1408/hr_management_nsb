@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
    
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/job_applieds')}}">jobapplieds</a></li>
                            <li class="breadcrumb-item active">Create New jobapplied </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New jobapplied </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.job_applieds.index') }}"> Back</a>
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
                        {!! Form::open(array('route' => ['hrm.job_applieds.update', $jobApplied->id],'method'=>'PATCH', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                  
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                </div>
                            </div>

                            <input id="job_id" type="hidden" name="job_post_id" class="form-control input-border-bottom" required="" value="{{ $jobApplied->job_post_id }}">

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="name">Job Title <span style="color:red">*</span>:</label>
                                    <input type="text" class="form-control" name="job_title" required="" value="{{ $jobApplied->job_title }}" readonly="">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Name <span style="color:red">*</span> :</label>
                                    <input type="text" class="form-control" name="name" id="name" required="" value="{{ $jobApplied->name }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="email">Email ID:</label>
                                    <input type="email" class="form-control" name="email" value="{{ $jobApplied->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile">Contact No.:</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ $jobApplied->phone }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="location">Gender:</label>
                                    <select class="form-control" name="gender">
                                        <option value="{{ $jobApplied->gender }}">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile">Date Of Birth.:</label>
                                    <input type="date" class="form-control" name="dob" value="{{ $jobApplied->dob }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="year">Experience in Year:</label>
                                    <select class="form-control" name="total_year_of_exp" id="experience-year" value="{{ $jobApplied->total_year_of_exp }}">
                                        <option value="{{ $jobApplied->status }}">Select</option>
                                        <option value="0">0 </option>
                                        <option value="1">1 </option>
                                        <option value="2">2 </option>
                                        <option value="3">3 </option>
                                        <option value="4">4 </option>
                                        <option value="5">5 </option>
                                        <option value="6">6 </option>
                                        <option value="7">7 </option>
                                        <option value="8">8 </option>
                                        <option value="9">9 </option>
                                        <option value="10">10 </option>
                                        <option value="11">11 </option>
                                        <option value="12">12 </option>
                                        <option value="13">13 </option>
                                        <option value="14">14 </option>
                                        <option value="15">15 </option>
                                        <option value="16">16 </option>
                                        <option value="17">17 </option>
                                        <option value="18">18 </option>
                                        <option value="19">19 </option>
                                        <option value="20">20 </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="month">Experience in Months:</label>
                                    <select class="form-control" name="exp_month" id="experience-month" value="{{ $jobApplied->exp_month }}">
                                        <option value="">Select</option>
                                        <option value="0">0 </option>
                                        <option value="1">1 </option>
                                        <option value="2">2 </option>
                                        <option value="3">3 </option>
                                        <option value="4">4 </option>
                                        <option value="5">5 </option>
                                        <option value="6">6 </option>
                                        <option value="7">7 </option>
                                        <option value="8">8 </option>
                                        <option value="9">9 </option>
                                        <option value="10">10 </option>
                                        <option value="11">11 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">

                                    <label for="quali">Educational Qualification:</label>
                                    <input type="text" class="form-control" name="qualification" value="{{ $jobApplied->qualification }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="key">Skill Set:</label>
                                    <input type="text" class="form-control" name="skill_set" value="{{ $jobApplied->skill_set }}">

                                </div>
                            </div>
                            <div class="row form-group">


                                <div class="col-md-6">
                                    <label for="file">Most Recent Employer:</label>
                                    <input type="text" class="form-control" name="recent_employee" value="{{ $jobApplied->recent_employee }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="file">Most Recent job Title:</label>
                                    <input type="text" class="form-control" name="recent_job_title" value="{{ $jobApplied->recent_job_title }}">
                                </div>


                                <div class="col-md-6">
                                    <label for="file">Current Post code :</label>
                                    <input type="text" class="form-control" name="zip" id="zip" onchange="getcode();" value="{{ $jobApplied->zip }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Current Location / Address:</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $jobApplied->address }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="file">Expected salary(GBP):</label>
                                    <input type="number" class="form-control" name="expected_salary" value="{{ $jobApplied->expected_salary }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="addr">Uplaod Cover Letter:</label>
                                    <input type="file" class="form-control" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="cover_letter" value="{{ $jobApplied->cover_letter }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="addr">Uplaod Resume <span style="color:red">*</span>:</label>
                                    <input type="file" class="form-control" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="resume"  value="{{ $jobApplied->resume }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                    <option value="{{ $jobApplied->status }}" @selected(old('status')==$jobApplied->status)>
                                            {{ $jobApplied->status }}
                                        </option>
                                    <option value="">Select</option>
                                        <option value="Application Received">Application Received</option>
                                        <option value="Short listed">Short listed</option>

                                        <option value="Interview">Interview</option>
                                        <option value="Online Screen Test">Online Screen Test</option>
                                        <option value="Written Test">Written Test</option>

                                        <option value="Telephone Interview">Telephone Interview</option>
                                        <option value="Face to Face Interview">Face to Face Interview</option>

                                        <option value="Job Offered">Job Offered</option>

                                        <option value="Hired">Hired</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Rejected">Rejected</option>

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
    </div><!-- end page content -->
    @include('layouts.footer')
    @endsection