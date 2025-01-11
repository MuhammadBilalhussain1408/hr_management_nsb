@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('content-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.contents.create') }}"> Create New content</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">contents Management</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                            <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Submenu</th>
                                        <th>name</th>
                                        <th>image</th>
                                        <th>image2</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $datas as $key => $data)
                                    <tr>
                                        <td>@if($data->menus){{ $data->menus->name }}@endif</td>
                                        <td> @if($data->submenus){{ $data->submenus->name }}@endif</td>
                                        <td>{{ $data->name }}</td>
                                        <td><img class="col-md-6" src="{{asset('/upload/content/'.$data->image)}}"></td>
                                        <td><img class="col-md-6" src="{{ asset('/upload/content/'.$data->image2) }}"></td>
                                        <td>
                                            @can('content-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.contents.edit',$data->id) }}">Edit</a>
                                            @endcan
                                            @can('content-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.contents.destroy', $data->id],'style'=>'display:inline']) !!}
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