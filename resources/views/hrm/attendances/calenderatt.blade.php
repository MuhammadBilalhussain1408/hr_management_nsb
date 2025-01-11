@extends('layouts.app-input')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (if you haven't already included it) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


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
                     
                        <div class="row">
                            <di class="col-md-6">
                                <a class="btn btn-primary" href="{{ route('hrm.attendances.index') }}"> Back</a>
                            </di>
                            <di class="col-md-6">
                                <div id="dateTimeDisplay" style="font-size: 15px; text-align:right"></div>
                            </di>
                        </div>
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

                        {!! Form::open(array('route' => 'hrm.attendances.store','method'=>'POST')) !!}
                        <br>
                        <!-- <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Select Employee </label>
                                    <select class="form-control " id="employee_id" name="employee_id">
                                    <option value="" > Select Employee </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Time In</strong>
                                    <input class="form-control" type="time" name="TimeIn" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <strong>Time Out</strong>
                                    <input class="form-control" type="time" name="Timeout" value="">
                                   
                                </div>
                            </div>
                            
                        </div>
                        <div class="row form-group">

                            <div class="col-xs-12 col-sm-12 col-md-12" >
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </div> -->
                        <table id="datatable" data-order='[[ 0, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                 <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th class="dt-no-sorting">Duration(Min.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($emps as $key => $emp)
                                        @php
                                            // Check if attendance exists for today
                                            $attendance = \App\Models\Attendance::where('employee_id', $emp->id)
                                                ->whereDate('date', now()->toDateString())
                                                ->first();
                                            //dd($attendance->duration);
                                            
                                            $disableCheckIn = $attendance && $attendance->checked_in;
                                            $disableCheckOut = $attendance && $attendance->checked_out
                                           
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td> <!-- Serial Number -->
                                            <td>{{ $emp->fname }} {{ $emp->lname }}</td> <!-- Employee Name -->
                                            <td>{{ $emp->department_name }}</td> <!-- Department Name -->
                                            <td>{{ $emp->designation_name }}</td> <!-- Designation -->
                                            <td>
                                                <input type="checkbox" 
                                                    name="checkIn" 
                                                    class="checkIn" 
                                                    data-emp-id="{{ $emp->id }}" 
                                                    data-designation-id="{{ $emp->designation_id }}" 
                                                    data-department-id="{{ $emp->department_id }}" 
                                                    data-org-id="{{ $emp->org_id }}"
                                                    {{ $disableCheckIn ? 'disabled' : '' }}
                                                    {{ $disableCheckIn ? 'checked' : '' }}> <!-- Disable if already checked-in -->
                                            </td> <!-- Check-In -->
                                            <td>
                                                <input type="checkbox" 
                                                    name="checkOut" 
                                                    class="checkOut" 
                                                    data-emp-id="{{ $emp->id }}" 
                                                    data-designation-id="{{ $emp->designation_id }}" 
                                                    data-department-id="{{ $emp->department_id }}" 
                                                    data-org-id="{{ $emp->org_id }}"
                                                    {{ !$disableCheckIn ? 'disabled' : '' }}
                                                    {{ $disableCheckOut ? 'disabled' : '' }}
                                                    {{ $disableCheckOut ? 'checked' : '' }}> <!-- Disable if already checked-out -->
                                            </td> <!-- Check-Out -->
                                            <td>
                                                {{$attendance->duration ?? null}}
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                        </table>
                        {!! Form::close() !!}

                        
                    </div>
                </div>
            </div>
   
        </div><!-- container -->
        @endcan
        @include('layouts.footer')
    </div><!-- end page content -->
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employee_id').select2({
                    placeholder: "Select an Employee",  // Placeholder text
                    allowClear: true,  // Allow clearing the selection
                });
             changeEmp();
        });

            function changeEmp() {
                $.ajax({
                    type: 'GET',
                    url: '/hrm/get_employee',
                    cache: false,
                    success: function(response) {
                        // Uncomment for debugging purposes
                        // console.log(response);
                        var obj_data = jQuery.parseJSON(response);

                        var output = '';
                        output += '<option value="" > Select Employee </option>';
                        $.each(obj_data, function(i, data) {
                            output += '<option value="' + data.id + '"> ' + data.fname + ' ' + data.mid_name + ' ' + data.lname + ' (' + data.code + ') </option>';
                        });
                        $('#employee_id').html(output);
                    }
                });
            }

    </script>
   <script>
    function updateDateTime() {
      // Get current date and time
      const now = new Date();
      const yyyy = now.getFullYear();
      const mm = String(now.getMonth() + 1).padStart(2, '0'); // Add leading zero
      const dd = String(now.getDate()).padStart(2, '0'); // Add leading zero
      const hours = String(now.getHours()).padStart(2, '0'); // Add leading zero
      const minutes = String(now.getMinutes()).padStart(2, '0'); // Add leading zero
      const seconds = String(now.getSeconds()).padStart(2, '0'); // Add leading zero

      // Format the date and time as 'YYYY-MM-DD HH:MM:SS'
      const formattedDateTime = `${yyyy}-${mm}-${dd} ${hours}:${minutes}:${seconds}`;

      // Display it in the div
      document.getElementById('dateTimeDisplay').textContent = formattedDateTime;
    }

    // Update the date and time every second
    setInterval(updateDateTime, 1000);

    // Call it once immediately to show the date and time without waiting for the interval
    updateDateTime();
  </script>
  <script>
   $(document).on('change', '.checkIn', function () {
    if ($(this).is(':checked')) {
        // Get the data attributes
        const empId = $(this).data('emp-id');
        const designationId = $(this).data('designation-id');
        const departmentId = $(this).data('department-id');
        const orgId = $(this).data('org-id');
        const type = $(this).attr('name'); // Check-In or Check-Out
       // alert(type);
        // Send AJAX request
        $.ajax({
            url: "{{ route('hrm.attendances.store') }}", // Laravel route
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // CSRF token
                employee_id: empId,
                designation_id: designationId,
                department_id: departmentId,
                org_id: orgId,
                type: type // Check-In or Check-Out
            },
            success: function (response) {
                if (response && response.message) {
                    // Show the message from the response in the alert
                    alert(response.message);
                } 
                //alert('Attendance marked successfully!');
                // Disable the checkbox after marking attendance
                $(`input[data-emp-id='${empId}'][name='${type}']`).prop('disabled', true);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while marking attendance.');
            }
        });
    }
});

$(document).on('change', '.checkOut', function () {
    if ($(this).is(':checked')) {
        // Get the data attributes
        const empId = $(this).data('emp-id');
        const designationId = $(this).data('designation-id');
        const departmentId = $(this).data('department-id');
        const orgId = $(this).data('org-id');
        const type = $(this).attr('name'); // Check-In or Check-Out
      //  alert(type);
        // Send AJAX request
        $.ajax({
            url: "{{ route('hrm.attendances.store') }}", // Laravel route
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // CSRF token
                employee_id: empId,
                designation_id: designationId,
                department_id: departmentId,
                org_id: orgId,
                type: type // Check-In or Check-Out
            },
            success: function (response) {
                if (response && response.message) {
                    // Show the message from the response in the alert
                    alert(response.message);
                } 
                //alert('Attendance marked successfully!');
                // Disable the checkbox after marking attendance
                $(`input[data-emp-id='${empId}'][name='${type}']`).prop('disabled', true);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while marking attendance.');
            }
        });
    }
});



</script>
    @endsection