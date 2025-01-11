@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('holiday-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/holiday')}}">Users</a></li>
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
                        <a class="btn btn-primary" href="{{ route('hrm.holidays.index') }}"> Back</a>
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
                        {!! Form::model($holiday, ['method' => 'PATCH','route' => ['hrm.holidays.update',
                        $holiday->id]]) !!}
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder">From Date</label>
                                    <input id="from_date" type="date" class="form-control " required="" name="from_date" value="{{$holiday->from_date}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="to_date" class="placeholder">To Date</label>
                                    <input id="to_date" type="date" class="form-control " name="to_date" required="" value="{{$holiday->to_date}}" onchange="calculateDays()" onclick="calculateDays()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="selectFloatingLabel" class="placeholder">Day</label>
                                    <select class="form-control input-border-bottom" id="selectFloatingLabel" required="" name="day">
                                        <option value="{{$holiday->day}}">{{$holiday->day}}</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thrusday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Holidat type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="holiday_type_id" required="" name="holiday_type_id">
                                        <option value="{{$holiday->holiday_type_id}}">{{$holiday->holiday_types->name}}</option>
                                        @foreach($htypes as $dep)
                                        <option value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="num_of_day" class="placeholder">No. of Days</label>
                                    <input id="num_of_day" type="text" class="form-control " required="" name="num_of_day" value="{{$holiday->num_of_day}}" readonly="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="body" class="placeholder">Holiday Description</label>
                                    <input id="body" type="text" class="form-control input-border-bottom" required="" name="body" value="{{$holiday->body}}">

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