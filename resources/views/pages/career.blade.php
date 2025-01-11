@extends('partial.layout-career')
@section('content')

<!--Start Main Contact Form Area-->
<section class="main-contact-form-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>{{$org->company_name}}</h3>
            </div>
            <h2>Job Description</h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="contact-form">
                    <h4>{{$org->company_name}}</h4>
                    <h5> Job Title :{{$data->job_title}} ({{$data->job_code}}) </h5>
                    <h5> No of Vacancy :{{$data->no_vac}} </h5>
                    <h5> Experience: {{$data->experience_min}} - {{$data->experience_max}} Years </h5>
                    <h5> Job Description / Responsibilities:</h5>
                    {!! $data->job_des !!}
                    <h5> Educational Qualification: {{$data->qualification}} </h5>
                    <h5> Skill: {{$data->skill_set}} </h5>
                    <h5> Gender: {{$data->gender}} </h5>
                    <h5> Age: {{$data->age_min}} - {{$data->age_max}} </h5>

                    <h5> Job Type: </h5>
                    <p> {{$data->job_type}}</p>

                    <h5> Working Hours:</h5>
                    <p> {{$data->working_hr}} </p>

                    <h5> Language Requirements: </h5>
                    <p> {{$data->language_required}} </p>

                    <h5>Salary : </h5>
                    <p>{{$data->salary_min}} - {{$data->salary_max}} </p>
                    <h5>Job Location : </h5>
                    <p>{{$data->job_location}} </p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="contact-form">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <h5>Last Date for Apply : </h5>
                            <p>{{$data->closing_date}} </p>
                            <a class="btn-info btn" href="{{URL::to('/career/application/'.$data->slug)}}"> Apply</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--End Main Contact Form Area-->

@endsection