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
                            <div class="col-lg-12"> <img src="{{asset('/assets/images/HRMS.png')}}" alt=""
                                    class="img-flu" wth="200">
                                <div
                                    style="position: fixed;   opacity: 0.5;   /* Safari */  -webkit-transform: rotate(-20deg); /* Firefox */  -moz-transform: rotate(-20deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; margin-top: 20px; margin-left: 585px; white-space: nowrap;color:#292e6a1c !important;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <address>
                                        <strong> {{$employee->fname}} {{$employee->mid_name}} {{$employee->lname}} </strong><br>
                                        {{$employee->nationality}}
                                        <p> Date: {{$rem}}</p>
                                        <strong> Subject: Right to Work Documentation – Temporary Visa {{$days}}-day Reminder.</strong>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div
                                    style="position: fixed;   opacity: 0.2;   /* Safari */  -webkit-transform: rotate(-60deg); /* Firefox */  -moz-transform: rotate(-60deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; font-size: 74px; margin-top: 92px; margin-left: 200px; white-space: nowrap;color:#292e6a1c !important;">
                                    HRMS!
                                </div>
                                <p> Further to your employment on a temporary visa, I am writing to remind you that this visa is due to expire on 01/01/2022. You are therefore requested to make arrangements to renew your right to work documentation in order for you to remain in employment.</p>

                                <p>Examples of the documents we require are as follows:</p>
                                <ul>
                                <ol>1. A copy of your completed application; and</ol>
                                <ol>2. Proof of postage; and/or</ol>
                                <ol>3. An acknowledgement letter from the Home Office confirming receipt of your application</ol>
                                <ol>4. Where a Certificate of Application provides you with the right to work it is your responsibility to ensure your certificate of application is always dated within 6 months</ol>
                                </ul>
                                <p> {{$org->company_name}} will complete a check with the Home Office Employer Checking Service to obtain confirmation of any application at the time of your visa expiring or at 5 monthly intervals dependent on the checking requirements for the right to work documents you provide to us. Where a negative verification notice is received, we cannot continue to employ you, unless you are able to provide alternative evidence to satisfy us that you have the right to work.</p>

                                <p>As previously advised, the immigration, Asylum and the Nationality Act 2006 requires all employers to make documentation checks at the start of every new colleague’s employment. This legislation also requires employers to carry out follow-up checks where the documents provided only give a colleague the temporary right to work in the UK. This also forms part of the employment with {{$org->company_name}}</p>

                                <p>Please bring your original documents into the HR team without delay or no later than & 15 days of issuance of letter;. Otherwise, we will have no option but to review your ongoing right to work when your current visa expires. A failure to provide sufficient document evidencing your ongoing right to work in the UK could result {{$org->company_name}} taking action, which may include considering the summary termination of your employment. Please do not hesitate to contact me if you have any concern or would like to discuss this further.</p>

                                <p>Please do not hesitate to contact me if you have any concern or would like to discuss this further.</p>

                                <p>Yours sincerely</p>

                                <p> {{$org->company_name}} </p>

                                <p> @if($employee->designation){{$employee->designation->name}} @endif</p>
                                </p>
                            </div>
                        </div>
                    
                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group d-print-none" role="group">
                                <a href="javascript:window.print()" class="btn btn-info text-light"><i
                                        class="fa fa-print"></i></a>

                                <a href="{{URL::to('/hrm/employees')}}" class="btn btn-dark text-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->

    @endsection