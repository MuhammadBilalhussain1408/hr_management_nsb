@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('shift-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/shifts')}}">shift</a></li>
                            <li class="breadcrumb-item active">Create New shift </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New shift </h4>
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

                        {!! Form::open(array('route' => 'hrm.shifts.store','method'=>'POST')) !!}
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
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Work in time</label>
                                    <input id="in_time" type="time" class="form-control " required="" name="in_time" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                       
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Work out time</label>
                                    <input id="out_time" type="time" class="form-control " required="" name="out_time" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Break time from</label>
                                    <input id="break_time_from" type="time" class="form-control " required="" name="break_time_from" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Break time to</label>
                                    <input id="break_time_to" type="time" class="form-control " required="" name="break_time_to" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Shift description</label>
                                    <textarea id="body" type="text" class="form-control " required="" name="body" value=""> </textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">Shift code</label>
                                    <input id="shift_code" type="text" class="form-control " required="" name="shift_code" placeholder="Shift-1" value="">
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
                        output += '<option value = "' + data.id + '" selected> ' + data.name +
                            '</option>';
                    });
                    $('#designation_id').html(output);
                    // document.getElementById("title").innerHTML = response;

                }
            });
        }
    </script>
    @endsection