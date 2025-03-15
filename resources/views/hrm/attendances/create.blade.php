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
            color: rgb(12, 2, 2);
            border-radius: 10px 10px 0 0;
        }

        /* Close Button */
        .modal-header .close {
            color: rgb(14, 4, 4);
            font-size: 24px;
            opacity: 1;
        }

        .modal-header .close:hover {
            color: rgb(12, 1, 1);
        }

        /* FullCalendar Styling */
        #calendar {
            padding: 20px;
            background: rgb(141, 187, 233);
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
            background: #007bff !important;
            /* Blue background for header */
            color: #ffffff !important;
            /* White text for contrast */
            font-weight: bold;
            padding: 10px;
            text-transform: uppercase;
            border: 1px solid #ddd;
        }

        /* Fix Calendar Date Text */
        .fc-daygrid-day-number {
            color: #333 !important;
            /* Dark text color for better visibility */
            font-weight: bold;
        }

        /* Optional: Style Weekend Days */
        .fc-day-sat,
        .fc-day-sun {
            background: rgb(170, 84, 84) !important;
            /* Light gray background for weekends */
        }

        /* Hover Effect for Dates */
        .fc-daygrid-day:hover {
            background: #e3f2fd !important;
            /* Light blue highlight on hover */
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
                    left: 'prev next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                height: 'auto',
                events: [] // Initially empty, filled dynamically via AJAX
            });

            $('#attandanceModal').on('shown.bs.modal', function() {
                calendar.render();
            });

            window.calendar = calendar; // Make the calendar instance accessible globally
        });

        function markAttendanceModal(data) {
            var id = data['id'];

            $.ajax({
                url: '/hrm/get_emp_attendance/' + id,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log('Success:', response);

                    window.calendar.removeAllEvents(); // Clear existing events

                    var events = response.map(item => {
                        if (!item.status) {
                            // Show checkbox for missing attendance
                            return {
                                title: '<input type="checkbox" class="attendance-checkbox" data-date="' +
                                    item.date + '"> Mark Attendance',
                                start: item.date,
                                allDay: true
                            };
                        } else {
                            // Show normal event for present/absent days
                            return {
                                title: item.status,
                                start: item.date,
                                backgroundColor: item.status === "Present" ? "green" : "red",
                                textColor: "#fff"
                            };
                        }
                    });

                    window.calendar.addEventSource(events);
                    window.calendar.render();
                    const excludedClasses = ['fc-day-sun', 'fc-day-sat'];
                    // Select all <td> elements with role="gridcell"
                    const gridCells = document.querySelectorAll('td[role="gridcell"]');
                    console.log(gridCells);

                    // Loop through each element and add the click event listener
                    gridCells.forEach(cell => {
                        // Check if the <td> has any of the excluded classes
                        const hasExcludedClass = excludedClasses.some(className => cell.classList
                            .contains(className));
                        let innerText = cell.innerText;
                        if (!hasExcludedClass && !(innerText.includes('Present') || innerText.includes(
                                'absent'))) {
                            const button = document.createElement('button');
                            button.textContent = 'Mark';
                            button.classList.add('btn',
                                'btn-primary'); // You can add any bootstrap or custom classes here

                            // Append the button inside the <td>
                            cell.appendChild(button);
                            // Add the event listener only if it doesn't have the excluded classes
                            button.addEventListener('click', function() {
                                // Your code to handle the click event
                                console.log('Grid cell clicked:', );
                                let clickedDate = cell.getAttribute('data-date');
                                // Get the modal element
                                var myModal = new bootstrap.Modal(document.getElementById(
                                    'attandanceModalmark'));

                                // Open the modal
                                myModal.show();
                                $('#attendance_date').val(clickedDate);
                            });
                        }
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }
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
                                        <button type="button" data-toggle="modal"
                                                        data-target="#ExportModal"
                                            class="btn btn-primary">Export Attendance</button>
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
                                                    {{ $attendance ? $attendance->checked_in : 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? $attendance->checked_out : 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? $attendance->duration . ' hours' : 'N/A' }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#attandanceModalmark"
                                                        onclick="markAttendanceModal12({{ json_encode($emp) }},'{{ $disableCheckIn }}', '{{ $disableCheckOut }}','{{ @$attendance->attendance_status }}')">
                                                        Mark
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#attandanceModal"
                                                        onclick="markAttendanceModal12({{ json_encode($emp) }},'{{ $disableCheckIn }}', '{{ $disableCheckOut }}','{{ @$attendance->attendance_status }}'), markAttendanceModal({{ json_encode($emp) }},'{{ $disableCheckIn }}', '{{ $disableCheckOut }}','{{ @$attendance->attendance_status }}')">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                {!! Form::close() !!}
                                <!-- Modal Mark-->
                                <div class="modal fade" id="attandanceModalmark" tabindex="-1"
                                    aria-labelledby="attandanceModalLabel" aria-hidden="true" style="z-index: 9999">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attandanceModalLabel">Add Attendance</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="attendance_date">Date</label>
                                                            <input type="date" class="form-control" name="attendance_date"
                                                                id="attendance_date" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="attendance_status">Status</label>
                                                            <select class="form-control" name="attendance_status"
                                                                id="attendance_status" onchange="checkAttendanceStatus()">
                                                                <option value="Present">Present</option>
                                                                <option value="Absent">Absent</option>
                                                                <option value="Leave">Leave</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="checkInTime">Check In Time</label>
                                                            <input type="time" class="form-control" name="check_in_time"
                                                                id="checkInTime">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="checkOutTime">Check Out Time</label>
                                                            <input type="time" class="form-control" name="check_out_time"
                                                                id="checkOutTime">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary"
                                                            onclick="MarkCheckInCheckOut()">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modalview -->
                                <div class="modal fade" id="attandanceModal" tabindex="-1"
                                    aria-labelledby="attandanceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attandanceModalLabel">Add Attendance</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modalview -->
                                <div class="modal fade" id="ExportModal" tabindex="-1"
                                    aria-labelledby="ExportModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ExportModalLabel">Export</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('hrm.attendances.export_attendance')}}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="">From Date</label>
                                                            <input type="date" class="form-control" placeholder="From Date" name="from_date" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">To Date</label>
                                                            <input type="date" class="form-control" placeholder="To Date" name="to_date" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-success mt-5">Export</button>
                                                        </div>
                                                    </div>
                                                </form>
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
        $(document).ready(function() {
            // Ensure the modal is properly initialized
            $(document).on('shown.bs.modal', '#attandanceModal, #attandanceModalmark', function() {
                console.log("Modal Opened: " + $(this).attr('id')); // Debugging log
            });

            // Reload the page when any modal is closed
            $(document).on('hidden.bs.modal', function(event) {
                var modalId = $(event.target).attr('id');
                if (modalId === "attandanceModal" || modalId === "attandanceModalmark") {
                    console.log("Modal Closed: " + modalId); // Debugging log
                    // location.reload();
                }
            });
        });
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
            let attendanceDate = $('#attendance_date').val();
            let checkInTime = $('#checkInTime').val();
            let checkOutTime = $('#checkOutTime').val();
            let attendanceStatus = $('#attendance_status option:selected').val();

            if (!attendanceDate.trim()) {
                alert('Please select an attendance date.');
                return false;
            }

            if (!attendanceStatus.trim()) {
                alert('Please select an attendance status.');
                return false;
            }

            const empId = selectedRow.id;
            const designationId = selectedRow.designation_id;
            const departmentId = selectedRow.department_id;
            const orgId = selectedRow.org_id;

            console.log(empId, designationId, departmentId, orgId, attendanceDate, checkInTime, checkOutTime,
                attendanceStatus);

            $.ajax({
                url: "{{ route('hrm.attendances.store') }}", // Laravel route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    employee_id: empId,
                    designation_id: designationId,
                    department_id: departmentId,
                    org_id: orgId,
                    attendance_date: attendanceDate,
                    check_in_time: checkInTime,
                    check_out_time: checkOutTime,
                    attendance_status: attendanceStatus
                },
                success: function(response) {
                    console.log(response);

                    if (response && response.message) {
                        alert(response.message);
                    }

                    $('#attandanceModalmark').modal('hide'); // Close modal
                    location.reload(); // Reload the page to update the data
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while marking attendance.');
                }
            });
        }
    </script>
@endsection
