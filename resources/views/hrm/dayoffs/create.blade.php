@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('dayoff-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/dayoffs')}}">shift</a></li>
                            <li class="breadcrumb-item active">Create New shift </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New dayoff </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.dayoffs.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.dayoffs.store','method'=>'POST')) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);">
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
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id" onchange="chngdesignation(this.value);">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Sift code </label>
                                    <select class="form-control input-border-bottom" id="shift_code" name="shift_id">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-10">
                                <div class="form-group">
                                    <h6>Day off</h6>
                                    <input type="checkbox"  class="col-md-2"  name="sunday" value="0">
                                    <label for="vehicle1">Sunday</label>

                                    <input type="checkbox" class="col-md-2" name="monday" value="0">
                                    <label for="vehicle1">Monday</label>

                                    <input type="checkbox"  class="col-md-2"  name="tuesday" value="0">
                                    <label for="vehicle1">Tuesday</label>

                                    <input type="checkbox"  class="col-md-2"  name="wednesday" value="0">
                                    <label for="vehicle1">Wednesday</label>

                                    <input type="checkbox"  class="col-md-2"  name="thursday" value="0">
                                    <label for="vehicle1">Thursday</label>

                                    <input type="checkbox"  class="col-md-2"  name="friday" value="0">
                                    <label for="vehicle1">Friday</label>

                                    <input type="checkbox"  class="col-md-2"  name="saturday" value="0">
                                    <label for="vehicle1">Saturday</label>&nbsp; &nbsp; &nbsp;

                                   
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
                    console.log(response);
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

        function chngdesignation(empid) {
            var dep_id = $("#department_id option:selected").val();

            $.ajax({
                type: 'GET',
                url: '/hrm/shift_code/' + empid + '/' + dep_id,
                cache: false,
                success: function(response) {
                    console.log(response);
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
    </script>
    @endsection