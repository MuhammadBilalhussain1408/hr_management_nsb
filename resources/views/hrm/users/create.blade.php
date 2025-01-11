@extends('layouts.app-input')
@section('content')
<link href="{{asset('assets/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('user-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/users')}}">Users</a></li>
                            <li class="breadcrumb-item active">Create New User </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New User </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.users.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.users.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' =>
                                    'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' =>
                                    'form-control', 'id' => 'e_mail', 'required')) !!}
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please fill the Email
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' =>
                                    'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm
                                    Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Company Name:</strong>
                                    @if (($userRole == 'Supper Admin') || ($userRole == 'Admin'))
                                    <input class="form-control" name="company_name" type="text">
                                    @else
                                    <select class="form-control" name="organization_id">
                                        <option value="">Select</option>
                                        @if((Auth::user()->company_name) || (Auth::user()->org->id))
                                        <option value="{{Auth::user()->org->id}}"> {{Auth::user()->org->company_name}}</option>
                                        @endif
                                    </select>
                                    
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Addres:</strong>
                                    {!! Form::text('address', null, array('placeholder' => 'Address','class' =>
                                    'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Website:</strong>
                                    {!! Form::text('website', null, array('placeholder' => 'website','class' =>
                                    'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="immigration" id="immigration" {{ old('immigration') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="immigration">
                                        {{ __('Immigration') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms_conditions" id="terms_conditions" {{ old('terms_conditions') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="terms_conditions">
                                        {{ __('Tirms & Conditions') }}
                                    </label>
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
    <script src="{{asset('assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.profile.init.js')}}"></script>
    @endsection