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
                            <li class="breadcrumb-item"><a href="{{('/hrm/home')}}">Dashboard</a></li>
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
                            <div class="col-lg-12"> <img src="{{asset('/assets/images/UK HR CLOUD.png')}}" alt="" class="img-flu" wth="200">
                                <div style="position: fixed;   opacity: 0.5;   /* Safari */  -webkit-transform: rotate(-20deg); /* Firefox */  -moz-transform: rotate(-20deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; margin-top: 20px; margin-left: 585px; white-space: nowrap;color:#292e6a1c !important;">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="float-left text-left">
                                    <address>
                                        <strong class="font-14"> {{$employee->fname}} {{$employee->m_name}} {{$employee->lname}}</strong><br>
                                        {{$org->address1}}, {{$org->city}}, {{$org->zip}} ,{{$org->country}}
                                        Date : {{$employee->date_change}}
                                    </address>
                                    <h4>Subject: Change of Circumstances - Annual Reminder. </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="position: fixed;   opacity: 0.2;   /* Safari */  -webkit-transform: rotate(-60deg); /* Firefox */  -moz-transform: rotate(-60deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; font-size: 74px; margin-top: 92px; margin-left: 200px; white-space: nowrap;color:#292e6a1c !important;">
                                    UK HR CLOUD!
                                </div>


                                <p>To comply with Home Office guidance, we have an obligation to report changes in sponsored migrant contact details to the Home Office via the sponsor management system within 10 days of the change occurring. In this regard please update (in applicable) change of circumstances details (e.g. change of Passport, BRP card, Immigration Status, Nationality, Residential and/or Correspondences address, landline telephone number and mobile telephone number, Emergency contact details, Next of Kin details, Disability Information, Registrations and Memberships status, Job Title). Please notify us immediately if there is any change in circumstances at your end. Mentionable, your historic contact details will be retained in the form of hardcopy and/or digital format. You can also update such information yourself by logging into <a href="https://ukhrcloud.com/admin/login" target="_blank" class="text-info">https://ukhrcloud.com/admin/login </a>with your employee login credentials.</p>

                               <p> Please do not hesitate to contact your HR/line manager if you have any concern or would like to discuss this further.</p>

                                <p> Yours sincerely </p>

                                <p> {{$org->f_name}} {{$org->l_name}}</p>

                                <p>Director </p>

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