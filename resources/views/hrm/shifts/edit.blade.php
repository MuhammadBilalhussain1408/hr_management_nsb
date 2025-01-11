@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('shift-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/shift')}}">Users</a></li>
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
                        <a class="btn btn-primary" href="{{ route('hrm.shifts.index') }}"> Back</a>
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
                        {!! Form::model($shift, ['method' => 'PATCH','route' => ['hrm.shifts.update',
                        $shift->id]]) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);">
                                        <option value="{{$shift->department_id}}">{{$shift->department->name}}</option>
                                        @foreach($departments as $dep)
                                        <option value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Designation </label>
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id">
                                        <option value="{{$shift->designation_id}}" selected="">{{$shift->designation->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Work in time</label>
                                    <input id="in_time" type="time" class="form-control " required="" name="in_time" value="{{$shift->in_time}}">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Work out time</label>
                                    <input id="out_time" type="time" class="form-control " required="" name="out_time" value="{{$shift->out_time}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Break time from</label>
                                    <input id="break_time_from" type="time" class="form-control " required="" name="break_time_from" value="{{$shift->break_time_from}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Break time to</label>
                                    <input id="break_time_to" type="time" class="form-control " required="" name="break_time_to" value="{{$shift->break_time_to}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Shift description</label>
                                    <textarea id="body" type="text" class="form-control " required="" name="body" value="">{{$shift->body}} </textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Shift code</label>
                                    <input id="shift_code" type="text" class="form-control " required="" name="shift_code" placeholder="Shift-1" value="{{$shift->shift_code}}">
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