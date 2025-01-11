@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('shift-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.shifts.create') }}"> Create New shift</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">shifts Management</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                            <thead>
                                    <tr>
                                        <th>Shift code</th>
                                        <th>shift Details</th>
                                        <th>Work in time</th>
                                        <th>Work out time</th>
                                        <th>Break time from</th>
                                        <th>Break time to</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($shifts as $key => $shift)
                                    <tr>
                                        <td>{{ $shift->shift_code }}</td>
                                        <td>{{ $shift->body }}</td>
                                        <td>{{ $shift->in_time }}</td>
                                        <td>{{ $shift->out_time }}</td>
                                        <td>{{ $shift->break_time_from }}</td>
                                        <td>{{ $shift->break_time_to }}</td>
                                        <td>
                                            @can('shift-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.shifts.edit',$shift->id) }}">Edit</a>
                                            @endcan
                                            @can('shift-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.shifts.destroy', $shift->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $shifts->render() !!}
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