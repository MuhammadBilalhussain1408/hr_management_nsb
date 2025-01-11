@extends('layouts.app-datatables')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('service-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.services.create') }}"> Create New service</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">services Management</h5>
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
                                        <th>Name</th>
                                        <th>Meta title</th>
                                        <th>Meta Keywords</th>
                                        <th>Charge </th>
                                        <th>details</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $key => $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->meta_title }}</td>
                                        <td>{{ $service->meta_keywords }}</td>
                                        <td>{{ $service->amount }}</td>
                                        <td>{{ $service->details }}</td>
                                        <td>{{ $service->status }}</td>
                                        <td>
                                            @can('service-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.services.edit',$service->id) }}"><span class="fa fa-edit"></span></a>
                                            @endcan
                                            @can('service-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.services.destroy', $service->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger"> <span class="fa fa-trash"></span></button>
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
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
@endsection