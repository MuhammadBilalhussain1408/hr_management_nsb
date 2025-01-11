@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('bankcode-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.bankcodes.create') }}"> Create New bankcode</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">bankcodes Management</h5>
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
                                        <th>Bank Name</th>
                                        <th>Short code</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($bankcodes as $key => $bankcode)
                                    <tr>
                                        <td>{{ $bankcode->id }}</td>
                                        <td>{{ $bankcode->bank->name }}</td>
                                        <td>{{ $bankcode->code }}</td>
                                        <td>{{ $bankcode->status }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('hrm.bankcodes.show',$bankcode->id) }}">Show</a>
                                            @can('bankcode-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.bankcodes.edit',$bankcode->id) }}">Edit</a>
                                            @endcan
                                            @can('bankcode-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.bankcodes.destroy', $bankcode->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $bankcodes->render() !!}
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