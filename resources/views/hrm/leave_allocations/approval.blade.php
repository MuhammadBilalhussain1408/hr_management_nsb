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
                     
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Emoployee type</th>
                                        <th>leave type</th>
                                        <th>Emp code</th>
                                        <th>Emp name </th>
                                        <th>From date </th>
                                        <th>To Date </th>
                                        <th> Date of Application </th>
                                        <th>No of Leave </th>
                                        <th>Status </th>
                                        <th>Remark </th>
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
                                        <td>{{ $lva->emp->fname }} {{ $lva->emp->mid_name }} {{ $lva->emp->lname }}</td>
                                        <td>{{ $lva->leave_rules->effect_from }}</td>
                                        <td>{{ $lva->leave_rules->effect_to }}</td>
                                        <td>{{ $lva->created_at }}</td>
                                        <td>{{ $lva->leave_hand }}</td>
                                        <td> 
                                            @if($lva->status == 'Approved')
                                            <span class="badge badge-pill badge-success">{{ $lva->status }} </span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ $lva->status }} </span>
                                            @endif
                                        </td>
                                        <td>{{ $lva->leave_types->remarks }}</td>
                                        <td>
                                            @can('Leave-allocation-edit')
                                            @if($lva->status == 'Approved')
                                            @else
                                            {!! Form::open(['method' => 'POST','route' => ['hrm.approved', $lva->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Approved', ['class' => 'btn btn-success']) !!}
                                                {!! Form::close() !!}
                                            @endif
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