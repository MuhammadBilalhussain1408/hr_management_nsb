@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Leave-allocation-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">LeaveAllocations Management
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                       
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.leave_allocations.search','method'=>'POST')) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_type_id" required="" name="employee_type_id" onchange="chngdepartment(this.value);">
                                        <option value="">Select All</option>
                                        @forelse($etypes as $emp)
                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee Code:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_id" required="" name="employee_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder"> Year </label>
                                    <select class="form-control" id="effect_year" required="" name="effect_year">
                                        <option value="">Select</option>
                                        {{ $last= date('Y')-4 }}
                                        {{ $now = date('Y')+4 }}

                                        @for ($i = $now; $i >= $last; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Create New LeaveAllocation</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Emoployee type</th>
                                        <th>leave type</th>
                                        <th>Emp code</th>
                                        <th>Emp name </th>
                                        <th>Max num of day</th>
                                        <th>Leave in hand</th>
                                        <th>Effective Year</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($LeaveAllocations as $key => $lva)
                                    <tr>
                                        <td>{{ $lva->id }}</td>
                                        <td>{{ $lva->emp_types->name }}</td>
                                        <td>{{ $lva->leave_types->name }}</td>
                                        <td>{{ $lva->emp->code }}</td>
                                        <td>{{ $lva->emp->fname }}</td>
                                        <td>{{ $lva->leave_rules->max_no }}</td>
                                        <td>@if($lva->leave_rules){{ $lva->leave_rules->max_no - $lva->leave_hand}}@endif</td>
                                        <td>{{ $lva->effect_year }}</td>
                                        <td>
                                            @can('Leave-allocation-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.leave_allocations.edit',$lva->slug) }}">Edit</a>
                                            @endcan
                                            @can('Leave-allocation-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.leave_allocations.destroy', $lva->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $LeaveAllocations->render() !!}
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
            url: '/hrm/get_emp_ytpe/' + empid,
            cache: false,
            success: function(response) {
                console.log(response);
                var obj_data = JSON.parse(response);
                var output = '';
                output += '<option value = "all"> Select all </option>';
                $.each(obj_data, function(i, data) {
                    output += '<option value = "' + data.id + '" selected> ' + data.fname + ' ' + data.mid_name + ' ' + data.lname + ' {' + data.code + ' )' +
                        '</option>';
                });
                $('#employee_id').html(output);
                // document.getElementById("title").innerHTML = response;

            }
        });
    }
</script>
@endsection