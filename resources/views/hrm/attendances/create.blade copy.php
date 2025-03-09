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
                            @extends('layouts.app-input')

@section('content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (if you haven't already included it) -->
    <style>
            /* Fullscreen Modal Styling */
            .modal-fullscreen {
                width: 100vw;
                height: 100vh;
                margin: 0;
                padding: 0;
            }

            .modal-fullscreen .modal-content {
                height: 100vh;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                background: #ffffff;
                border: none;
            }

            /* Modal Header */
            .modal-header {
                background: #007bff;
                color:rgb(12, 2, 2);
                border-radius: 10px 10px 0 0;
            }

            /* Close Button */
            .modal-header .close {
                color:rgb(14, 4, 4);
                font-size: 24px;
                opacity: 1;
            }

            .modal-header .close:hover {
                color:rgb(12, 1, 1);
            }

            /* FullCalendar Styling */
            #calendar {
                padding: 20px;
                background:rgb(141, 187, 233);
                border-radius: 10px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            }

            /* Calendar Header Styling */
            .fc-toolbar-title {
                font-size: 22px !important;
                font-weight: bold;
                color: #007bff;
            }

            .fc-col-header-cell {
            background: #007bff !important;  /* Blue background for header */
            color: #ffffff !important;  /* White text for contrast */
            font-weight: bold;
            padding: 10px;
            text-transform: uppercase;
            border: 1px solid #ddd;
        }

        /* Fix Calendar Date Text */
        .fc-daygrid-day-number {
            color: #333 !important; /* Dark text color for better visibility */
            font-weight: bold;
        }

        /* Optional: Style Weekend Days */
        .fc-day-sat, .fc-day-sun {
            background:rgb(170, 84, 84) !important; /* Light gray background for weekends */
        }

        /* Hover Effect for Dates */
        .fc-daygrid-day:hover {
            background: #e3f2fd !important; /* Light blue highlight on hover */
            transition: 0.3s ease-in-out;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: new Date(),
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        height: 'auto',
        events: [],
        eventContent: function(arg) {
            return { 
                html: `<div style="text-align:center; font-size:12px;">${arg.event.title}</div>` 
            };
        },
        eventDidMount: function(info) {
            let eventEl = info.el;
            eventEl.style.backgroundColor = info.event.extendedProps.backgroundColor;
            eventEl.style.borderColor = info.event.extendedProps.backgroundColor;
            eventEl.style.color = info.event.extendedProps.textColor || '#fff';
        }
    });

    // Fetch data when modal is shown
    $('#attandanceModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var empId = button.data('id');
        fetchAttendance(empId);
    });

    function fetchAttendance(empId) {
        $.ajax({
            url: '/hrm/get_emp_attendance/' + empId,
            type: 'GET',
            success: function(response) {
                calendar.removeAllEvents();
                
                if (response.length > 0) {
                    let events = response.map(item => ({
                        title: item.status,
                        start: item.date,
                        allDay: true,
                        extendedProps: {
                            backgroundColor: getStatusColor(item.status),
                            textColor: '#fff'
                        }
                    }));
                    calendar.addEvents(events);
                } else {
                    showCheckboxCalendar(calendar);
                }
                
                calendar.render();
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

    function showCheckboxCalendar(calendar) {
        let today = new Date();
        let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        let lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        let events = [];

        for (let d = new Date(firstDay); d <= lastDay; d.setDate(d.getDate() + 1)) {
            let dateStr = d.toISOString().split('T')[0];
            events.push({
                title: `<input type="checkbox" class="attendance-checkbox" data-date="${dateStr}">`,
                start: dateStr,
                allDay: true,
                extendedProps: {
                    backgroundColor: '#f8f9fa',
                    textColor: '#000'
                }
            });
        }

        calendar.addEvents(events);
    }

    function getStatusColor(status) {
        const colors = {
            'Present': 'green',
            'Absent': 'red',
            'Leave': 'orange'
        };
        return colors[status] || 'gray';
    }

    calendar.render();
});

   
   </script>

    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            @can('attendance-create')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ '/attendances' }}">attendance</a></li>
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

                                {!! Form::open(['route' => 'hrm.attendances.store', 'method' => 'POST']) !!}
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('hrm.attendances.bulk_attendance') }}"
                                            class="btn btn-primary float-right">Mark Bulk Attendance</a>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <table id="datatable" data-order='[[ 0, "asc" ]]' data-page-length='20'
                                    class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Employee Name</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th class="dt-no-sorting">Status</th>
                                            <th class="dt-no-sorting">CheckIn</th>
                                            <th class="dt-no-sorting">Checkout</th>
                                            <th class="dt-no-sorting">Duration</th>
                                            <th class="dt-no-sorting">Mark Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emps as $key => $emp)
                                            @php
                                                // Check if attendance exists for today
                                                $attendance = \App\Models\Attendance::where('employee_id', $emp->id)
                                                    ->whereDate('date', now()->toDateString())
                                                    ->first();
                                                //dd($attendance->duration);

                                                $disableCheckIn = $attendance && $attendance->checked_in;
                                                $disableCheckOut = $attendance && $attendance->checked_out;

                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td> <!-- Serial Number -->
                                                <td>{{ $emp->fname }} {{ $emp->lname }}</td> <!-- Employee Name -->
                                                <td>{{ $emp->department_name }}</td> <!-- Department Name -->
                                                <td>{{ $emp->designation_name }}</td> <!-- Designation -->
                                                <td>
                                                    {{ $attendance->status ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? $attendance->created_at->format('H:i') : 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? $attendance->updated_at->format('H:i') : 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? $attendance->created_at->diffInMinutes($attendance->updated_at) : 'N/A' }}
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-primary"
                                                    data-toggle="modal" data-target="#attandanceModal"
                                                    data-id="{{ $emp->id }}" 
                                                    data-disable-checkin="{{ $disableCheckIn }}"
                                                    data-disable-checkout="{{ $disableCheckOut }}"
                                                    data-attendance-status="{{ @$attendance->attendance_status }}">
                                                    Mark
                                                </button>

                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                {!! Form::close() !!}
                                <!-- Modal -->
                                <div class="modal fade" id="attandanceModal" tabindex="-1" aria-labelledby="attandanceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attandanceModalLabel">Add Attendance</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- container -->
            @endcan
            @include('layouts.footer')
        </div><!-- end page content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
 
  
   
    </script>
    <script>
        function checkAttendanceStatus() {
            let status = $('#attendance_status option:selected').val();
            if (status == 'Absent' || status == 'Leave') {
                $('#checkInBox').attr('disabled', true);
                $('#checkOutBox').attr('disabled', true);
            } else {
                $('#checkInBox').attr('disabled', false);
                $('#checkOutBox').attr('disabled', false);
            }
        }
        let selectedRow = null;




        function markAttendanceModal12(data, disableCheckIn, disableCheckOut, attandence_status) {
            console.log(data, attandence_status);

            selectedRow = data;
            if (attandence_status.trim()) {
                $(`#attendance_status option[value="${attandence_status}"]`).prop('selected', true);
            }
            if (disableCheckIn) {
                $('#checkInBox').attr('checked', true).attr('disabled', true);
            }
            if (!disableCheckIn && !disableCheckOut) {
                $('#checkOutBox').attr('disabled', true);
            }
            if (disableCheckOut) {
                $('#checkOutBox').attr('checked', true).attr('disabled', true);
            }
        }
        $(document).ready(function() {
            $('#employee_id').select2({
                placeholder: "Select an Employee", // Placeholder text
                allowClear: true, // Allow clearing the selection
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
                        output += '<option value="' + data.id + '"> ' + data.fname + ' ' + data
                            .mid_name + ' ' + data.lname + ' (' + data.code + ') </option>';
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
        function MarkCheckInCheckOut() {
            let checkType = $('.attendanceBox:checked').val();
            if (!checkType.trim()) {
                alert('Please Select Checkout Type');
                return false;
            }
            const empId = selectedRow.id;
            const designationId = selectedRow.designation_id;
            const departmentId = selectedRow.department_id;
            const orgId = selectedRow.org_id;
            const type = checkType;

            console.log(empId, designationId, departmentId, orgId, type);

            $.ajax({
                url: "{{ route('hrm.attendances.store') }}", // Laravel route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    employee_id: empId,
                    designation_id: designationId,
                    department_id: departmentId,
                    org_id: orgId,
                    type: type,
                    attendance_status: $('#attendance_status option:selected').val()
                },
                success: function(response) {
                    console.log(response);

                    if (response && response.message) {
                        // Show the message from the response in the alert
                        alert(response.message);
                    }
                    //alert('Attendance marked successfully!');
                    // Disable the checkbox after marking attendance
                    $(`input[data-emp-id='${empId}'][name='${type}']`).prop('disabled', true);
                    $('#attendanceModal').modal('hide');

                    // Reload the window
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while marking attendance.');
                }
            });
        }

        $(document).on('change', '.checkOut', function() {
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
                    success: function(response) {
                        if (response && response.message) {
                            // Show the message from the response in the alert
                            alert(response.message);
                        }
                        //alert('Attendance marked successfully!');
                        // Disable the checkbox after marking attendance
                        $(`input[data-emp-id='${empId}'][name='${type}']`).prop('disabled', true);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while marking attendance.');
                    }
                });
            }
        });
    </script>
@endsection
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