@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('LeaveRule-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.leave_rules.create') }}"> Create New leaveRule</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">leaveRules Management</h5>
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
                                        <th>From Date</th>
                                        <th>To date</th>
                                        <th>num of day</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($leaveRules as $key => $leaveRule)
                                    <tr>
                                        <td>{{ $leaveRule->id }}</td>
                                        <td>{{ $leaveRule->emp_types->name }}</td>
                                        <td>@if( $leaveRule->leave_types){{ $leaveRule->leave_types->name }}@endif</td>
                                        <td>{{ $leaveRule->effect_from }}</td>
                                        <td>{{ $leaveRule->effect_to }}</td>
                                        <td>{{ $leaveRule->max_no }}</td>
                                       
                                        <td>
                                            @can('LeaveRule-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.leave_rules.edit',$leaveRule->slug) }}">Edit</a>
                                            @endcan
                                            @can('LeaveRule-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.leave_rules.destroy', $leaveRule->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $leaveRules->render() !!}
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        @endcan
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
@endsection