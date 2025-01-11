@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('grace-period-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/grace-periods')}}">Grace period</a></li>
                            <li class="breadcrumb-item active">Edit </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit Grace period </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.grace_periods.index') }}"> Back</a>
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
                        {!! Form::model($graceperiod, ['method' => 'PATCH','route' => ['hrm.grace_periods.update',
                            $graceperiod->id]]) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);">
                                        <option value="{{$graceperiod->department_id}}">{{$graceperiod->department->name}}</option>
                                        @foreach($departments as $dep)
                                        <option value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Designation </label>
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id"  onchange="chngdesignation(this.value);" required>
                                        <option value="{{$graceperiod->designation_id}}" selected="">{{$graceperiod->designation->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Sift code </label>
                                    <select class="form-control input-border-bottom" id="grace-period_code" name="grace-period_id" >
                                        <option value="{{$graceperiod->shift_id}}" selected="" disabled="">{{$graceperiod->shift->shift_code}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Work in time</label>
                                    <input id="work_in_time" type="time" class="form-control " required="" name="work_in_time" value="{{$graceperiod->work_in_time}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Grace period time</label>
                                    <input id="grace_period_time" type="time" class="form-control " required="" name="grace_period_time" value="{{$graceperiod->grace_period_time}}">
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