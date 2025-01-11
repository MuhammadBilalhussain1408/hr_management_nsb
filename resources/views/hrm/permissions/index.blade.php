@extends('layouts.datatable_app')
@section('content')
@include('layouts.leftbar')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New Permission</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">Users Management</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                           <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                       <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permission as $key => $per)
                                    <tr>
                                        <td>{{ $per->name }}</td>
                                        <td>
                                            @can('permission-edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit',$per->id) }}">Edit</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $permission->render() !!}
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
@endsection