@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-flu">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">datas profile </li>
                        </ol>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
            <div class="text-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="text-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div><!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-md-12 col-lg-12 mx-auto">
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
                                <h2 class="text-center"> ABSENCE RECORD CARD </h2>
                            </div>
                            <div class="col-md-12">
                                <div class="float-left text-lete">
                                    <address>
                                        <strong>Department : {{$datas->department->name}} </strong><br>

                                        <strong>Designation : {{$datas->designation->name}} </strong><br>
                                    </address>
                                </div>
                                <div class="float-right text-right">
                                    <address>
                                        <strong>Name: {{$datas->fname}} {{$datas->m_name}} {{$datas->lname}} </strong> <br>
                                        <strong> Code: {{$datas->code}} </strong> <br>
                                        <sttrong> Year: {{$year}} </sttrong>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <div style="position: fixed;   opacity: 0.2;   /* Safari */  -webkit-transform: rotate(-60deg); /* Firefox */  -moz-transform: rotate(-60deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; font-size: 74px; margin-top: 92px; margin-left: 200px; white-space: nowrap;color:#292e6a1c !important;">
                                    UK HR CLOUD!
                                </div>
                                <div class="table-responsive">

                                    <table class="table table-bordered mb-5">

                                        <thead>

                                            <tr>
                                                <th></th>
                                                @for ($day = 01; $day <= 31; $day++) <th>{{$day}}</th>
                                                    @endfor
                                            </tr>
                                        </thead>
                                        <!-- <tbody>

                                            @for ($i=01; $i<=12; $i++) @php $month=date('F', mktime(0,0,0,$i, 1, date('Y'))); $m=date('m', mktime(0,0,0,$i, 1, date('Y'))); $checked_id_date=\Carbon\Carbon::parse($attend->pluck('date')->first());
                                                @endphp

                                                <tr class="tr-calender small">

                                                    <td><small>{{$month}}</small></td>
                                                    @forelse($attend as $aa)
                                                    @if($aa->status == 'P')
                                                    <td class="text-success">{{$aa->status}}</td>
                                                    @elseif($aa->status == 'off')
                                                    <td class="text-info">{{$aa->status}}</td>
                                                    @elseif($aa->status == 'A')
                                                    <td class="text-danger">{{$aa->status}}</td>
                                                    @elseif($aa->status == 'L')
                                                    <td class="text-warning">{{$aa->status}}</td>
                                                    @elseif($aa->status == 'H')
                                                    <td style="color:#742d5b">{{$aa->status}}</td>
                                                    @endif
                                                    @empty
                                                    @endforelse

                                                </tr>

                                                @endfor

                                        </tbody> -->
                                        <tbody>
                                            @for ($i = 01; $i <= 12; $i++) <tr class="tr-calender small">
                                                <td><small>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</small></td>
                                                @for ($day = 01; $day <= 31; $day++) 
                                                @php 
                                                $date=date('Y-m-d', mktime(0, 0, 0, $i, $day, $year));


                                                    @endphp
                                                    @forelse($attend as $aa)
                                                    @if((\Carbon\Carbon::parse($aa['date'])->format('Y-m-d') == $date) && ($aa->status == 'P'))
                                                    <td class="text-success">{{$aa->status}} </td>
                                                    @elseif((\Carbon\Carbon::parse($aa['date'])->format('Y-m-d') == $date) && ($aa->status == 'off'))
                                                    <td class="text-info">{{$aa->status}}</td>
                                                    @elseif((\Carbon\Carbon::parse($aa['date'])->format('Y-m-d') == $date) && ($aa->status == 'A'))
                                                    <td class="text-danger">{{$aa->status}}</td>
                                                    @elseif((\Carbon\Carbon::parse($aa['date'])->format('Y-m-d') == $date) && ($aa->status == 'L'))
                                                    <td class="text-warning">{{$aa->status}}</td>
                                                    @elseif((\Carbon\Carbon::parse($aa['date'])->format('Y-m-d') == $date) && ($aa->status == 'H'))
                                                    <td style="color:#742d5b">{{$aa->status}}</td>
                                                    @endif
                                                    @empty
                                                    @endforelse
                                                    @endfor
                                                    </tr>
                                                    @endfor
                                        </tbody>

                                    </table>
                                    <table class="table table-bordered mb-5">
                                        <tbody>
                                            <tr>

                                                <td style="border:none !important;">
                                                    <p class="text-danger">A : Authorised Absence</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p style="color:#742d5b">H : Holiday</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p class="text-warning">L : Leave</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p class="text-info">Off : Offday</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border:none !important;">
                                                    <p class="text-success">P : Present</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p style="color:#c4952c;">PH : Public Holiday</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p class="text-danger">U : Unauthorized Absent</p>
                                                </td>
                                                <td style="border:none !important;">
                                                    <p class="text-info">SL : Sick Leave</p>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group d-print-none" role="group">
                                <a href="javascript:window.print()" class="btn btn-info text-light"><i class="fa fa-print"></i></a>

                                <a href="{{URL::to('/datass')}}" class="btn btn-dark text-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->

    @endsection