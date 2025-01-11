@extends('layouts.app-datatables')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('organization-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.users.create') }}"> Add New user</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">organizations Management</h5>
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
                                        <th>organization Name</th>
                                        <th>Organization Address</th>
                                        <th>website</th>
                                        <th>Email id</th>
                                        <th>Phone No</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations as $organization)
                                    <tr>
                                        <td>{{ $organization->id }}</td>
                                        <td>{{ $organization->company_name }}</td>
                                        <td>{{ $organization->address }}</td>
                                        <td>{{ $organization->website }}</td>
                                        <td>{{ $organization->org_email }}</td>
                                        <td>{{ $organization->phone }}</td>
                                        <td>
                                            @can('organization-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.organizations.edit',$organization->slug) }}">Edit</a>
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