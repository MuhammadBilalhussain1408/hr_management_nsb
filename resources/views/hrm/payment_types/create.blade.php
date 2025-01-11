@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('PaymentType-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/payment_types')}}">PaymentTypes</a></li>
                            <li class="breadcrumb-item active">Create New PaymentType </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New PaymentType </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.payment_types.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.payment_types.store','method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Payment type</strong>
                                        {!! Form::text('payment_type', null, array('placeholder' => 'Payment type','class' =>
                                        'form-control')) !!}
                                        <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Working hour:</strong>
                                        <input class="form-control input-border-bottom" type="number" id="working_hr" required=""
                                            name="working_hr" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Rate </strong>
                                        <input class="form-control input-border-bottom" type="type" id="rate" required=""
                                            name="rate" />
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
    @endsection