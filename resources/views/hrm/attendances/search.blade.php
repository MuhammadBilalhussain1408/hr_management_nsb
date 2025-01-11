@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('late-policy-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.attendances.create') }}"> Create New Attendance</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Attendances Add</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.attendances.store','method'=>'POST')) !!}
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
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
                                    @for($x = $from_date; $x <= $to_date; $x++) @php $dayName=Carbon\Carbon::parse($x)->format('l'); @endphp
                                        <tr>
                                            <td>{{ $emp->code }}</td>
                                            <td>{{ $emp->fname }} {{ $emp->mid_name }} {{ $emp->lname }}</td>
                                            <td> <input type="date" class="form-control " required="" name="car[{{$x}}][date]" value="{{$x}}">
                                            </td>
                                            <td>
                                                <div class="form-group ">
                                                    <input id="employee_id" type="hidden" class="form-control " required="" name="employee_id" value="{{$emp->id}}">
                                                    <input id="shift_id" type="hidden" class="form-control " required="" name="shift_id" value="{{$shift->id}}">
                                                    <input id="organization_id" type="hidden" class="form-control " required="" name="organization_id" value="{{ Auth::user()->org->id}}">
                                                    <input id="department_id" type="hidden" class="form-control " required="" name="department_id" value="{{ Auth::user()->org->id}}">
                                                    <input id="designation_id" type="hidden" class="form-control " required="" name="designation_id" value="{{ Auth::user()->org->id}}">
                                                    <input id="checked_in{{ Carbon\Carbon::parse($x)->format('j')}}" type="time" class="form-control " required="" name="car[{{$x}}][checked_in]" value="{{$shift->in_time}}" onblur="setDutyHours({{ Carbon\Carbon::parse($x)->format('j')}})">
                                                    <!-- <input type="time" class="form-control" id="checked_in{{ Carbon\Carbon::parse($x)->format('j')}}" data-id="{{ Carbon\Carbon::parse($x)->format('j')}}" name="checked_in[]" value="" onblur="setDutyHours({{ Carbon\Carbon::parse($x)->format('j')}})"> -->
                                                </div>
                                            </td>
                                            <td>
                                                NA
                                            </td>
                                            <td>
                                                <div class="form-group ">
                                                    <input id="checked_out{{ Carbon\Carbon::parse($x)->format('j')}}" type="time" class="form-control " required="" name="car[{{$x}}][checked_out]" value="{{$shift->out_time}}" onblur="setDutyHours({{ Carbon\Carbon::parse($x)->format('j')}})" onchange="calculateDays({{ Carbon\Carbon::parse($x)->format('j')}})" onclick="calculateDays({{ Carbon\Carbon::parse($x)->format('j')}})">
                                                    <!-- <input type="time" class="form-control" id="checked_out{{ Carbon\Carbon::parse($x)->format('j')}}" data-id="{{ Carbon\Carbon::parse($x)->format('j')}}" name="checked_out[]" value="" onblur="setDutyHours({{ Carbon\Carbon::parse($x)->format('j')}})"> -->

                                                </div>
                                            </td>
                                            <td>
                                                NA
                                            </td>
                                            <td>
                                                <div class="form-group ">
                                                    <input type="text" class="form-control" readonly="" name="car[{{$x}}][duration]" id="duration{{ Carbon\Carbon::parse($x)->format('j')}}" data-id="{{ Carbon\Carbon::parse($x)->format('j')}}" value="0:00">
                                                    <!-- <input id="duration{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " name="duration[]" data-id="{{ Carbon\Carbon::parse($x)->format('j')}}" value="0:00"> -->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group ">{{$dayName}} @if(($dayName == 'Tuesday') && ($day_off->tuesday == 0) ) {{ $day_off->tuesday}} @endif
                                                    @if(($dayName == 'Thursday') && ($day_off->thursday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Friday') && ($day_off->friday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Saturday') && ($day_off->saturday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Sunday') && ($day_off->sunday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Monday') && ($day_off->monday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Tuesday') && ($day_off->tuesday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">

                                                    @elseif(($dayName == 'Wednesday') && ($day_off->wednesday == 0) )
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="off">
                                                    @elseif($leave->where('effect_year','=',$x)->value('effect_year'))
                                                    <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="L">


                                                    @else

                                                    @php
                                                    $holidayCount = 0; // Initialize the holiday count to zero
                                                    @endphp

                                                    @foreach ($holidays as $holiday)
                                                    @if (Carbon\Carbon::parse($holiday['from_date'])->format('Y-m-d') <= Carbon\Carbon::parse($x)->format('Y-m-d') &&
                                                        Carbon\Carbon::parse($holiday['to_date'])->format('Y-m-d') >= Carbon\Carbon::parse($x)->format('Y-m-d'))
                                                        @php
                                                        $holidayCount++;
                                                        @endphp
                                                        @endif
                                                        @endforeach

                                                        @if ($holidayCount > 0)
                                                        <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control" required="" name="car[{{$x}}][status]" value="H">
                                                        @else
                                                        <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control" required="" name="car[{{$x}}][status]" value="A">
                                                        @endif

                                                        <!-- <input id="status{{ Carbon\Carbon::parse($x)->format('j')}}" type="text" class="form-control " required="" name="car[{{$x}}][status]" value="A"> -->

                                                        @endif
                                                </div>
                                            </td>

                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        @endcan
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->


<script>
    function setDutyHours(val) {
        var timein = "checked_in" + val;
        var timeout = "checked_out" + val;
        var duration = "duration" + val;
        var status = "status" + val;

        // var timein_val = $.base64.encode($('#' + timein).val());
        var timein_val = $('#' + timein).val();
        var timeout_val = $('#' + timeout).val();
        console.log(timein);
        console.log($('#' + timein).val());
        // console.log($('#'+timeout).val());



        // Convert checked-in and checked-out times to Date objects
        var checkedInTime = new Date("1970-01-01 " + timein_val);
        var checkedOutTime = new Date("1970-01-01 " + timeout_val);

        // Calculate the duration in milliseconds
        var durationMs = checkedOutTime - checkedInTime;

        // Convert milliseconds to hours and minutes
        var durationMinutes = Math.floor(durationMs / 60000); // 1 minute = 60000 milliseconds
        var durationHours = Math.floor(durationMinutes / 60);
        durationMinutes = durationMinutes % 60;

        // Display the duration
        console.log(durationHours + " : " + durationMinutes);
        $('#' + duration).val(durationHours + " : " + durationMinutes)
        $('#' + status).val('P')


        // $.ajax({
        //     type: 'GET',
        //       url: "/hrm/get_duration/" + timein_val + '/' + timeout_val,
        //     cache: false,
        //     success: function(response) {
        //         const obj = JSON.parse(response);
        //           console.log(obj.hour);
        //         var dh = obj.hour + ':' + obj.min;
        //         $('#' + duration).val(dh)

        //     }
        // });
    }
</script>
@endsection