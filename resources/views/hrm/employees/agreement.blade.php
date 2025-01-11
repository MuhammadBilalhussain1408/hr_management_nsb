@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-flu">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee profile </li>
                        </ol>
                    </div>
                </div>
            </div>
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
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div><!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-md-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-left">{{$org->company_name}} </h3><br>
                                <h2 class="text-left"> <u>Contract of Employment</u> </h2>
                            </div>
                            <div class="col-md-12">
                                <div class="float-left">
                                    <address>
                                        <strong>Between the Employer, {{$org->company_name}} <br>
                                            {{$org->address}}, {{$org->address1}}, {{$org->road}}, {{$org->zip}}, {{$org->country}},<br>
                                            and the Employee {{$employee->fname}} {{$employee->mid_name}} {{$employee->lname}}</br>
                                            {{$employee->job_location}}, {{$employee->nationality}}</strong><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4> Start of Employment and Duration of Contract </h4>
                                <p>
                                    The employment will start on {{$employee->join_date}} and the Initial duration of work is a {{Carbon\Carbon::parse($employee->join_date)->format('y') - Carbon\Carbon::parse($employee->end_date)->format('y')}} year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Probationary Period </h4>
                                <p>
                                    The employment is subject to the completion of a 3months probationary period.<br>
                                    If, at the end of the probationary period, the Employee's performance is considered to be of a satisfactory
                                    standard, the appointment will be made permanent.<br>
                                    During the probationary period, one-week's notice may be given by either party to terminate this contract.<BR>
                                    In lieu of notice during the probationary period, the Employer may pay the Employee the salary that he
                                    would have earned till the end of probationary period.
                                </p>
                                <h4> Job Description </h4>
                                <p>
                                    The Employee is engaged initially to perform the duties of TRAINEE WAITER <br>
                                <ul>
                                    <li>Provide the perfect service experience for every Guest</li>
                                    <li>Ensure the Guest feels important and welcome in the restaurant</li>
                                    <li>Ensure hot food is hot and cold food is cold</li>
                                    <li>Adhere to timing standards for products and services</li>
                                    <li>Look for ways to consolidate service and increase table turns</li>
                                    <li>Present menu, answer questions and make suggestions regarding food and beverage</li>
                                    <li>Serve the Guest in an accommodating manner</li>
                                    <li>Apply positive suggestive sales approach to guide Guests</li>
                                    <li>Pre-bus tables; maintain table cleanliness, bus tables</li>
                                    <li>Looks for ways to avoid waste and limit costs</li>
                                    <li>Assist in keeping the restaurant clean and safe</li>
                                    <li>Provide responsible service of alcoholic beverages</li>
                                    <li>Deliver food and beverages to any table as needed</li>
                                    <li>Must follow all cash handling policies and procedures</li>
                                    <li>Report to property on time and in proper uniform</li>
                                </ul>
                                The Employee will, however, be expected to carry out any other reasonable duties in line with his
                                responsibilities to assist in the smooth operation of the business.
                                </p>
                                <h4> Qualifications </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Place of Work </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Working Hours </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Remuneration </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Overtime payments </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Holidays </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Sickness </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Pension Scheme </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Notice of Termination </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Redundancy </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Rules of Conduct </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Misconduct Leading to Summary Dismissal Without Notice </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Disciplinary Action </h4>
                                <p>
                                    The employment will start on 23/08/2021 and the Initial duration of work is a 3 year period. This contract
                                    may be extended in future subject to your performance and subject to immigration control if it is required
                                    for your visa condition.
                                </p>
                                <h4> Grievances </h4>
                                <strong>
                                    If you agree with the above terms and conditions please sign both copies of this Contract, retain one
                                    and return the other to me.
                                </strong><br>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <address>
                                        <h4> <strong>
                                                Signed ______________________________<br>
                                                for {{$org->company_name}},
                                        </h4></strong>
                                    </address>
                                </div>
                                <div class="float-right">
                                    <address>
                                        <h4><strong>
                                                Date: _______________
                                        </h4> </strong>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-left">
                                    <address>
                                        <h4> <strong>
                                                Signed ______________________________<br>
                                                for {{$employee->fname}} {{$employee->mid_name}} {{$employee->lname}},
                                        </h4> </strong>
                                    </address>
                                </div>
                                <div class="float-right">
                                    <address>
                                        <h4> <strong>
                                                Date: _______________
                                        </h4> </strong>
                                    </address>
                                </div>
                            </div>
                        </div>

                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group d-print-none" role="group">
                                <a href="javascript:window.print()" class="btn btn-info text-light"><i class="fa fa-print"></i></a>

                                <a href="{{URL::to('/employees')}}" class="btn btn-dark text-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->

    @endsection