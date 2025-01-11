@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('late-policy-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/latePolicy')}}">Users</a></li>
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
                        <a class="btn btn-primary" href="{{ route('hrm.late_policies.index') }}"> Back</a>
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
                        {!! Form::model($latePolicy, ['method' => 'PATCH','route' => ['hrm.late_policies.update',
                            $latePolicy->id]]) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);">
                                        <option value="{{$latePolicy->department_id}}">{{$latePolicy->department->name}}</option>
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
                                        <option value="{{$latePolicy->designation_id}}" selected="">{{$latePolicy->designation->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Sift code </label>
                                    <select class="form-control input-border-bottom" id="latePolicy_code" name="latePolicy_id" >
                                        <option value="{{$latePolicy->shift_id}}" selected="" disabled="">{{$latePolicy->shift->shift_code}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                       
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Maximum Grace Period in Minutes</label>
                                    <input id="max_grace" type="number" class="form-control " required="" name="max_grace" value="{{$latePolicy->max_grace}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">No. of Days Allow</label>
                                    <input id="days_allow" type="number" class="form-control " required="" name="days_allow" value="{{$latePolicy->days_allow}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">No. of Day Salary Deducted</label>
                                    <input id="day_salary_deduc" type="number" class="form-control " required="" name="day_salary_deduc" value="{{$latePolicy->day_salary_deduc}}">
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