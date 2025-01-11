@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('LeaveRule-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/leave_rules')}}">leave_rules</a></li>
                            <li class="breadcrumb-item active">Edit User </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit User </h4>
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
                        {!! Form::model($leaveRule, ['method' => 'PATCH','route' => ['hrm.leave_rules.update',
                        $leaveRule->id]]) !!}
                        <div class="row form-group">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_type_id" required="" name="employee_type_id">
                                        <option value="{{$leaveRule->emp_types->id}}">{{$leaveRule->emp_types->name}}</option>
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
                                        <option value="{{$leaveRule->leave_types->id}}">{{$leaveRule->leave_types->name}}</option>
                                        @foreach($leave_types as $ltype)
                                        <option value="{{$ltype->id}}">{{$ltype->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="max_no" class="placeholder">Maxximum no</label>
                                    <input id="max_no" type="type" class="form-control " required="" name="max_no" value="{{$leaveRule->max_no}}">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder">Effect From </label>
                                    <input id="from_date" type="date" class="form-control " required="" name="effect_from" value="{{$leaveRule->effect_from}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="to_date" class="placeholder"> Effect To </label>
                                    <input id="to_date" type="date" class="form-control " name="effect_to" required="" value="{{$leaveRule->effect_to}}">
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
    <script>
        function calculateDays() {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var fromdate = new Date(from_date);
            var todate = new Date(to_date);
            var diffDays = (todate.getDate() - fromdate.getDate()) + 1;
            $("#num_of_day").val(diffDays);
        }
    </script>
    @endsection