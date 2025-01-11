@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('tax-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.taxes.create') }}"> Create New tax</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">taxs Management</h5>
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
                                        <th>Tax Code</th>
                                        <th>Tax Reference</th>
                                        <th>Tax Reference</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($taxes as $key => $tax)
                                    <tr>
                                        <td>{{ $tax->id }}</td>
                                        <td>{{ $tax->tax_code }}</td>
                                        <td>{{ $tax->percentage_dis }}</td>
                                        <td>{{ $tax->tax_ref }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('hrm.taxes.show',$tax->id) }}">Show</a>
                                            @can('tax-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.taxes.edit',$tax->id) }}">Edit</a>
                                            @endcan
                                            @can('tax-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.taxes.destroy', $tax->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $taxes->render() !!}
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