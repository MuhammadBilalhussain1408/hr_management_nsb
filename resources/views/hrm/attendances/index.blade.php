@extends('layouts.app-datatables')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('attendance-list')
        <div class="row">
            <div class="col-sm-12">
            @can('attendance-create')
            <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.attendances.create') }}"> Create New attendance</a>
                </div>
                @endcan
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Search Attendances History</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.attendances.daily','method'=>'POST')) !!}
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
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id" onchange="chngdesignation(this.value);" required>
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Employee code </label>
                                    <select class="form-control input-border-bottom" id="employee_id" name="employee_id" onchange="designation_shift(this.value);" required>
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">From date</label>
                                    <input id="from_date" type="date" class="form-control " required="" name="from_date" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">To date</label>
                                    <input id="days_allow" type="date" class="form-control " required="" name="to_date" value="" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Daily Attendances</h5>
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Employee Code</th>
                                        <th>Employee Name</th>
                                        <th>Date</th>
                                        <th>Checkin</th>
                                        <th>Checkin Location</th>
                                        <th>Checkout</th>
                                        <th>Checkout Location</th>
                                        <th>Duty Hours</th>
                                         <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $key => $data)

                                    <tr>
                                        <td>{{$data->department_name}}</td>
                                        <td>{{$data->designation_name}}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->employee_fname }} {{$data->employee_mid_name }} {{ $data->employee_lname }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->checked_in }}</td>
                                        <td> NA </td>
                                        <td>{{ $data->checked_out }}</td>
                                        <td> NA </td>
                                        @php
                                        $in = Carbon\Carbon::createFromFormat('H:i:s',$data->checked_in) ;
                                        $out = Carbon\Carbon::createFromFormat('H:i:s',$data->checked_out);
                                        @endphp
                                        <td>{{ $in->diffAsCarbonInterval($out)->hours }} </td>
                                        <td>{{ $data->status }}</td>
                                    </tr>
                                  
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        @endcan
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
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