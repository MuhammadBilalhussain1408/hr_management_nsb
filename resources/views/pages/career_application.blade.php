@extends('partial.layout-career')
@section('content')

<!--Start Main Contact Form Area-->
<section class="main-contact-form-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>{{$org->company_name}}</h3>
                <div class="middle-box">
                    <p>{{$org->address}} {{$org->address1}}, {{$org->zip}} {{$org->road}}<br> {{$org->country}}</p>
                </div>
            </div>
            <h2>Job Application</h2>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="contact-form">
                    {!! Form::open(array('route' => 'post_application','method'=>'POST', 'id'=>'regForm',
                    'files'=>'true', 'enctype' =>'multipart/form-data')) !!}

                    <input id="job_id" type="hidden" name="job_post_id" class="form-control input-border-bottom" required="" value="{{$data->id}}">
                    <input id="organization_id" type="hidden" name="organization_id" class="form-control input-border-bottom" required="" value="{{$data->organization_id}}">

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="name">Job Title <span style="color:red">*</span>:</label>
                            <input type="text" class="form-control" name="job_title" required="" value="{{$data->job_title}}" readonly="">
                        </div>
                        <div class="col-md-6">
                            <label for="name">Name <span style="color:red">*</span> :</label>
                            <input type="text" class="form-control" name="name" id="name" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="email">Email ID:</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="mobile">Contact No.:</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="location">Gender:</label>
                            <select class="form-control" name="gender">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile">Date Of Birth.:</label>
                            <input type="date" class="form-control" name="dob" value="">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="year">Experience in Year:</label>
                            <select class="form-control" name="total_year_of_exp" id="experience-year">
                                <option value="">Select</option>
                                @for ($x = 0; $x <= 20; $x++) <option value="{{$x}}">{{$x}} </option>
                                    @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="month">Experience in Months:</label>
                            <select class="form-control" name="exp_month" id="experience-month">
                                <option value="">Select</option>
                                @for ($x = 0; $x <= 11; $x++) <option value="{{$x}}">{{$x}} </option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">

                            <label for="quali">Educational Qualification:</label>
                            <input type="text" class="form-control" name="qualification">
                        </div>

                        <div class="col-md-6">
                            <label for="key">Skill Set:</label>
                            <input type="text" class="form-control" name="skill_set">

                        </div>
                    </div>
                    <div class="row form-group">


                        <div class="col-md-6">
                            <label for="file">Most Recent Employer:</label>
                            <input type="text" class="form-control" name="recent_employee">
                        </div>

                        <div class="col-md-6">
                            <label for="file">Most Recent job Title:</label>
                            <input type="text" class="form-control" name="recent_job_title">
                        </div>


                        <div class="col-md-6">
                            <label for="file">Current Post code :</label>
                            <input type="text" class="form-control" name="zip" id="zip" onchange="getcode();">
                        </div>
                        <div class="col-md-6">
                            <label for="file">Current Location / Address:</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>

                        <div class="col-md-6">
                            <label for="file">Expected salary(GBP):</label>
                            <input type="number" class="form-control" name="expected_salary">
                        </div>
                        <div class="col-md-6">
                            <label for="addr">Uplaod Cover Letter:</label>
                            <input type="file" class="form-control" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="cover_letter">
                        </div>

                        <div class="col-md-6">
                            <label for="addr">Uplaod Resume <span style="color:red">*</span>:</label>
                            <input type="file" class="form-control" accept="application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="resume" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="button-box">
                                <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                <button class="btn-info btn " type="submit" data-loading-text="Please wait...">
                                    <span class="txt">
                                        Submit Application
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</section>
<!--End Main Contact Form Area-->

@endsection