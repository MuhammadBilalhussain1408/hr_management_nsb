@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('attendance-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/attendances')}}">attendance</a></li>
                            <li class="breadcrumb-item active">Create New attendance </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New attendance </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.attendances.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.attendances.search','method'=>'POST')) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);" required>
                                        <option value="">&nbsp;</option>
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
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Employee code </label>
                                    <select class="form-control input-border-bottom" id="employee_id" name="employee_id" onchange="designation_shift(this.value);" >
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                       
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">From date</label>
                                    <input id="from_date" type="date" class="form-control " required="" name="from_date" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">To date</label>
                                    <input id="days_allow" type="date" class="form-control " required="" name="to_date" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Sift code </label>
                                    <select class="form-control input-border-bottom" id="shift_code" name="shift_id" required="">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
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
        function chngdepartment(empid) {

            $.ajax({
                type: 'GET',
                url: '/hrm/get_designation/' + empid,
                cache: false,
                success: function(response) {
                 //   console.log(response);
                    var obj_data = JSON.parse(response);
                    var output = '';
                    output += '<option value = "0"> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.id + '"> ' + data.name +
                            '</option>';
                    });
                    $('#designation_id').html(output);
                    // document.getElementById("title").innerHTML = response;

                }
            });
        }
        function designation_shift(empid) {
            var dep_id = $("#department_id option:selected").val();
            var deg_id = $("#designation_id option:selected").val();
           // console.log(deg_id);
            $.ajax({
                type: 'GET',
                url: '/hrm/shift_code/' + deg_id + '/' + dep_id,
                cache: false,
                success: function(response) {
                 //   console.log(response);
                    var obj_data = jQuery.parseJSON(response);

                    var output = '';
                    output += '<option value = "0"> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.id + '"> ' + data.shift_code +
                            '</option>';
                    });
                    $('#shift_code').html(output);

                }
            });
        }
        function chngdesignation(empid) {
            var dep_id = $("#department_id option:selected").val();

            $.ajax({
                type: 'GET',
                url: '/hrm/get_employee/' + dep_id + '/' + empid,
                cache: false,
                success: function(response) {
                  //  console.log(response);
                    var obj_data = jQuery.parseJSON(response);

                    var output = '';
                    output += '<option value = "0"> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.id + '"> ' + data.fname + ' ' + data.mid_name + ' ' +data.lname + '(' + data.code + ')'
                            '</option>';
                    });
                    $('#employee_id').html(output);

                }
            });
        }
    </script>
    @endsection