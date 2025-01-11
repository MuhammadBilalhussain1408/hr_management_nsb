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
                        <h5 class="mt-0">Search Process Attendance</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.attendance.report_save','method'=>'POST')) !!}
                        @if(Auth::user()->roles->pluck('name')->first() == 'Employee')
                        <div class="row form-group">
                            <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                            <input class="form-control" type="hidden" name="employee_id" value="{{$employee->id}}">

                        </div>
                        @else
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);" required="">
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
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id" onchange="chngdesignation(this.value);" required="">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Employee code </label>
                                    <select class="form-control input-border-bottom" id="employee_id" name="employee_id" onchange="designation_shift(this.value);" required="">
                                        <option value="" selected="" disabled=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row form-group">

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">From date</label>
                                    <select class="form-control" id="from_date" type="year" required="" name="from_date">
                                        <option value="">Select</option>
                                        {{ $last= date('Y')-8 }}
                                        {{ $now = date('Y') }}

                                        @for ($i = $now; $i >= $last; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="placeholder">To date</label>
                                    <input id="days_allow" type="date" class="form-control " required="" name="to_date" value="">
                                </div>
                            </div> -->

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0"> Process Attendance</h5>
                        @if($datas)
                        <div class="col-sm-12">
                            <div class="page-title-box float-right"> <a class="btn btn-success" href="{{ URL::to('hrm/attendances/record/'.$datas->code.'/'.$year) }}"> view</a>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th> Selecct All
                                            <div class="form-group col-xs-10 col-sm-10 col-md-10">
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" id="select_all" />
                                                </div>
                                            </div>
                                        </th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Employee Code</th>
                                        <th>Employee Name</th>
                                        <th>Month</th>
                                        <th>No.of Working Days</th>
                                        <th>No.of Present Days</th>
                                        <th>No.of Absent Days</th>
                                        <th>No.of Leave Taken</th>
                                        <th>No.of Days Salary</th>
                                    </tr>
                                </thead>
                             
                                <tbody>
                                     @if(!empty($datas))
                                    @for ($i = 01; $i <= 12; $i++) @php $month=date('F', mktime(0, 0, 0, $i, 1, $year)); $m=date('m', mktime(0, 0, 0, $i, 1, $year)); $startOfMonth=\Carbon\Carbon::create($year, $m, 1); $endOfMonth=$startOfMonth->copy()->endOfMonth();
                                        $workingDayCount = 0;
                                        $weekendDays = [];

                                        if ($day_off->friday == 0) {
                                        $weekendDays[] = Carbon\Carbon::FRIDAY;
                                        }

                                        if ($day_off->saturday == 0) {
                                        $weekendDays[] = Carbon\Carbon::SATURDAY;
                                        }

                                        if ($day_off->sunday == 0) {
                                        $weekendDays[] = Carbon\Carbon::SUNDAY;
                                        }

                                        if ($day_off->monday == 0) {
                                        $weekendDays[] = Carbon\Carbon::MONDAY;
                                        }

                                        if ($day_off->tuesday == 0) {
                                        $weekendDays[] = Carbon\Carbon::TUESDAY;
                                        }

                                        if ($day_off->wednesday == 0) {
                                        $weekendDays[] = Carbon\Carbon::WEDNESDAY;
                                        }

                                        if ($day_off->thursday == 0) {
                                        $weekendDays[] = Carbon\Carbon::THURSDAY;
                                        }

                                        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
                                        if (!in_array($date->dayOfWeek, $weekendDays)) {
                                        // Exclude weekend days
                                        $workingDayCount++;
                                        }
                                        }
                                        $filteredAttend = $attend->filter(function ($item) use ($startOfMonth) {
                                            return $item->date->format('m') == $startOfMonth->format('m') && $item->status == 'P';
                                        });

                                        $checkedInCount22 = $filteredAttend->pluck('id')->count();
                                        $checkedInCount = number_format($checkedInCount22);
                                        $absentCount = $workingDayCount - $checkedInCount;
                                        if($leave){
                                            $leaveCount = $leave->where('effect_year', $startOfMonth->format('m'))->pluck('leave_hand')->count();
                                        }
                                        @endphp
                                        @php
                                        $holidayCount = 0; // Initialize the holiday count to zero
                                        @endphp
                                        @foreach ($holidays as $holiday)
                                        @if (Carbon\Carbon::parse($holiday['from_date'])->format('m') <= Carbon\Carbon::parse($i)->format('m') &&
                                            Carbon\Carbon::parse($holiday['to_date'])->format('m') >= Carbon\Carbon::parse($i)->format('m'))
                                        @php
                                        $holidayCount++;
                                        @endphp
                                        @endif
                                        @endforeach
                                       
                                        <tr>
                                            <td>
                                                <div class="form-group col-xs-10 col-sm-10 col-md-10">
                                                    <div class="checkbox checkbox-info">
                                                        <input type="checkbox" class="checkbox" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td>@if($datas->department){{ $datas->department->name }}@endif</td>
                                            <td>@if($datas->designation){{ $datas->designation->name }}@endif</td>
                                            <td>{{ $datas->code }}</td>
                                            <td>{{ $datas->fname }} {{ $datas->mid_name }} {{ $datas->lname }}</td>
                                            <td>{{$month }}</td>
                                            <td>{{ $workingDayCount - $holidayCount}} </td>
                                            <td>{{ $checkedInCount }}</td>
                                            <td>{{ $absentCount }}</td>
                                            <td>{{ $leaveCount }}</td>
                                            <td>{{ $checkedInCount }}</td>
                                        </tr>
                                       
                                        @endfor
                                        @endif
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
    var select_all = document.getElementById("select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

    //select all checkboxes
    select_all.addEventListener("change", function(e) {
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = select_all.checked;
        }
    });

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e) { //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if (this.checked == false) {
                select_all.checked = false;
            }
            //check "select all" if all checkbox items are checked
            if (document.querySelectorAll('.checkbox:checked').length == checkboxes.length) {
                select_all.checked = true;
            }
        });
    }
</script>
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
                output += '<option value = ""> Selected </option>';
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
                output += '<option value = ""> Selected </option>';
                $.each(obj_data, function(i, data) {
                    output += '<option value = "' + data.id + '" selected> ' + data.fname + ' ' + data.mid_name + ' ' + data.lname + '(' + data.code + ')'
                    '</option>';
                });
                $('#employee_id').html(output);

            }
        });
    }
</script>
@endsection