@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('menu-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.menus.create') }}"> Create New menu</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">menus Management</h5>
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
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $key => $menu)
                                    <tr>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->meta_title }}</td>
                                        <td>{{ $menu->meta_keywords }}</td>
                                        <td><img class="col-md-4" src="{{asset('/upload/menu/'.$menu->image)}}"></td>
                                        <td>{{ $menu->status }}</td>
                                        <td>
                                            @can('menu-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.menus.edit',$menu->id) }}"><span class="fa fa-edit"></span></a>
                                            @endcan
                                            @can('menu-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.menus.destroy', $menu->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger"> <span class="fa fa-trash"></span></button>
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $menus->render() !!}
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