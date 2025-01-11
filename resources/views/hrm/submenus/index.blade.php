@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('submenu-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.submenus.create') }}"> Create New submenu</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">submenus Management</h5>
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
                                        <th>image</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submenus as $key => $submenu)
                                    <tr>
                                        <td>{{ $submenu->id }}</td>
                                        <td>{{ $submenu->name }}</td>
                                        <td>{{ $submenu->meta_title }}</td>
                                        <td>{{ $submenu->meta_keywords }}</td>
                                        <td><img class="col-md-4" src="{{asset('/upload/submenu/'.$submenu->image)}}"></td>
                                        <td>{{ $submenu->status }}</td>
                                        <td>
                                            @can('submenu-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.submenus.edit',$submenu->id) }}"><span class="fa fa-edit"></span></a>
                                            @endcan
                                            @can('submenu-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.submenus.destroy', $submenu->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger"> <span class="fa fa-trash"></span></button>
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $submenus->render() !!}
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