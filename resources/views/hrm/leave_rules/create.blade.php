@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('LeaveRule-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/leave_rules')}}">leave_rule</a></li>
                            <li class="breadcrumb-item active">Create New leave_rule </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New leave_rule </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.leave_rules.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.leave_rules.store','method'=>'POST')) !!}
                        <div class="row form-group">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_type_id" required="" name="employee_type_id">
                                        <option value="">Select</option>
                                        @forelse($etypes as $emp)
                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Leave type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="leave_type_id" required="" name="leave_type_id">
                                        <option value="">Select</option>
                                        @foreach($leave_types as $ltype)
                                        <option value="{{$ltype->id}}">{{$ltype->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="max_no" class="placeholder">Maxximum no</label>
                                    <input id="max_no" type="type" class="form-control " required="" name="max_no" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder">Effect From </label>
                                    <input id="from_date" type="date" class="form-control " required="" name="effect_from" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="to_date" class="placeholder"> Effect To </label>
                                    <input id="to_date" type="date" class="form-control " name="effect_to" required="" value="" onchange="calculateDays()" onclick="calculateDays()">
                                </div>
                            </div>
                           
                            <div class="col-xs-12 col-sm-12 col-md-12">
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