@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('duty-roster-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.duty_rosters.create') }}"> Create New duty-roster</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">duty_rosters Management</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                            <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Shift code</th>
                                        <th>From date</th>
                                        <th>To date</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $datas as $key => $lpolicy)
                                    <tr>
                                        <td>{{ $lpolicy->department->name }}</td>
                                        <td>{{ $lpolicy->designation->name }}</td>
                                        <td>{{ $lpolicy->emp->fname }}</td>
                                        <td>{{ $lpolicy->from_date }}</td>
                                        <td>{{ $lpolicy->to_date }}</td>
                                        <td>
                                            @can('duty-roster-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.duty_rosters.edit',$lpolicy->id) }}">Edit</a>
                                            @endcan
                                            @can('duty-roster-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.duty_rosters.destroy', $lpolicy->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $datas->render() !!}
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