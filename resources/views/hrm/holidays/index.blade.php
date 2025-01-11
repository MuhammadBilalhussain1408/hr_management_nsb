@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('holiday-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.holidays.create') }}"> Create New Holiday</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">holidays Management</h5>
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
                                        <th>Holiday type</th>
                                        <th>From Date</th>
                                        <th>To date</th>
                                        <th>num of day</th>
                                        <th>Day</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($holidays as $key => $holiday)
                                    <tr>
                                        <td>{{ $holiday->id }}</td>
                                        <td>{{ $holiday->holiday_types->name }}</td>
                                        <td>{{ $holiday->from_date }}</td>
                                        <td>{{ $holiday->to_date }}</td>
                                        <td>{{ $holiday->num_of_day }}</td>
                                        <td>{{ $holiday->day }}</td>
                                        <td>
                                            @can('holiday-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.holidays.edit',$holiday->slug) }}">Edit</a>
                                            @endcan
                                            @can('holiday-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.holidays.destroy', $holiday->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $holidays->render() !!}
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