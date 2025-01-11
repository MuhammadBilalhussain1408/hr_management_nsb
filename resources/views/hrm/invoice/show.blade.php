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
                                <h2 class="text-center"> UKHR Cloud </h2>
                            </div>
                            <div class="col-md-12">
                                <div class="float-left text-lete">
                                    <address>
                                        <strong> {{$invoice->org->name}} </strong><br>

                                        <strong>
                                            info@ukhrcloud.co.uk<br>
                                            www.ukhrcloud.co.uk </strong>
                                    </address>
                                </div>
                                <div class="float-right text-right">
                                    <address>
                                        <img src="{{asset('/assets/images/logo.svg')}}" alt="logo" class="logo-sm" height="100px">
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-left text-lete">
                                    <address>

                                        <strong>
                                            Bill To: {{$invoice->org->f_name}} {{$invoice->org->l_name}} <br>
                                            {{$invoice->org->address}}{{$invoice->org->road}} {{$invoice->org->address1}}, {{$invoice->org->city}}, {{$invoice->org->post}} {{$invoice->org->country}}
                                        </strong>
                                    </address>
                                </div>
                                <div class="float-right text-right">
                                    <address>
                                        Pro Forma Invoice. no.: {{$invoice->invoice_no}} <br>
                                        Issue Date: {{Carbon\Carbon::parse($invoice->bill_date)}}

                                    </address>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="position: fixed;   opacity: 0.2;   /* Safari */  -webkit-transform: rotate(-60deg); /* Firefox */  -moz-transform: rotate(-60deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; font-size: 74px; margin-top: 92px; margin-left: 200px; white-space: nowrap;color:#292e6a1c !important;">
                                    UK HR CLOUD!
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Sl. no </th>
                                                <th>Description </th>
                                                <th>Quantity </th>
                                                <th>Unit price Excluding VAT </th>
                                                <th> Taxable Unit price </th>
                                                <th> Total </th>
                                            </tr>

                                            <tr>
                                                <td>1</td>
                                                <td>{{$invoice->body}}</td>
                                                <td>1</td>
                                                <td>£{{$invoice->amount}}</td>
                                                <td>£{{$invoice->amount}}</td>
                                                <td>£{{$invoice->amount}}</td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                                <td>Subtotal</td>
                                                <td>1</td>
                                                <td>£{{$invoice->amount}}</td>
                                                <td>£{{$invoice->amount}}</td>
                                                <td>£{{$invoice->amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Total Excluding VAT</td>
                                                <td>£{{$invoice->amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Total Including VAT</td>
                                                <td>£{{$invoice->amount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            @php
                            $amount = $invoice->amount;
                            $locale = 'en_GB'; // Locale for Great Britain
                            $formatter = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);

                            $words = $formatter->format($amount);

                            $amountInWords = "GBP " . ucfirst($words) . " Only.";
                            @endphp
                                <p class="text-left small"> Amount in words: GBP. {{$amountInWords}} </p>
                            </div>
                           
                            @if($invoice->status == 'Not Paid')
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-center">
                                        <tbody>
                                            <tr>
                                                <td>Please make payment to below account details within next 5 days </td>
                                            </tr>
                                            <tr>
                                                <td>UKHR CLoud
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sort Code: {{$invoice->bank_code}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Account Number: {{$invoice->account_no}}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-left"> Thank you for selecting UKHR Cloud as your preferred business partner!<br>
                                    This is a system generated invoice and require no signature. </p>
                                <p class="text-center"> UKHR Cloud is Regulated to provide immigration services by the <br>
                                    Immigration Ser-vices Commissioner.
                                    <!-- Registration No. F202100311. -->
                                    "This is not a Tax Invoice."
                                </p>
                                </p>
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-center">
                                        <tbody>
                                            <tr>
                                                <td>Sort Code: {{$invoice->bank_code}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Account Number: {{$invoice->account_no}}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-left"> Thank you for selecting UK HR Cloud as your preferred business partner! This is a
                                    system generated invoice and require no signature. </p>
                                </p>
                            </div>

                            @endif

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