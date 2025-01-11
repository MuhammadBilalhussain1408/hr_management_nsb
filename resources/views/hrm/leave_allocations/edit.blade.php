@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Leave-allocation-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/leave_allocations')}}">leave_allocations</a></li>
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
                        <a class="btn btn-primary" href="{{ route('hrm.leave_allocations.index') }}"> Back</a>
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
                        {!! Form::model($LeaveAllocation, ['method' => 'PATCH','route' => ['hrm.leave_allocations.update',
                        $LeaveAllocation->id]]) !!}
                        <div class="row">
                            <input id="organization_id" type="hidden" class="form-control " required="" name="organization_id" value="{{  Auth::user()->org->id }}" disabled>
                            <input id="leave_rule_id" type="hidden" class="form-control " required="" name="leave_rule_id" value="{{ $LeaveAllocation->leave_type_id }}" disabled>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="leave_type_id" class="placeholder">Leave type</label>
                                    <input id="leave_type_id" type="text" class="form-control " required="" name="leave_type_id" value="{{  $LeaveAllocation->leave_types->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="code" class="placeholder">Employee code</label>
                                    <input id="code" type="text" class="form-control " required="" value="{{  $employee->code }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="employee_type_id" class="placeholder">Max no of leave</label>
                                    <input id="max_no" type="text" class="form-control " required="" name="max_no" value="{{ $lrule->max_no }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="employee_type_id" class="placeholder">Employee type</label>
                                    <input id="employee_type_id" type="text" class="form-control " required="" name="employee_type_id" value="{{$LeaveAllocation->emp_types->name }}" disabled>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="leave_hand" class="placeholder">Leave in hand</label>
                                    @if($employee->leave_allocation)
                                    <input id="leave_hand" type="type" class="form-control " required="" name="leave_hand" value="{{ $lrule->max_no - $employee->leave_allocation->max_no  }}">
                                    @else
                                    <input id="leave_hand" type="type" class="form-control " required="" name="leave_hand" min="1" max="{{ $lrule->max_no - $employee->max_no  }}" value="{{ $lrule->max_no - $employee->max_no  }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group ">
                                    <label for="effect_year" class="placeholder">Effective Year</label>
                                    <input id="effect_year" type="date" class="form-control " required="" name="effect_year" value="{{ $LeaveAllocation->effect_year  }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <button type="submit" class="btn btn-primary">Save</button>
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