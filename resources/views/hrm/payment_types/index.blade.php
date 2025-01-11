@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('PaymentType-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.payment_types.create') }}"> Create New PaymentType</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">PaymentTypes Management</h5>
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
                                        <th>Pay Type</th>
                                        <th>working hour</th>
                                        <th>Rate</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($payment_types as $key => $PaymentType)
                                    <tr>
                                        <td>{{ $PaymentType->id }}</td>
                                        <td>{{ $PaymentType->payment_type }}</td>
                                        <td>{{ $PaymentType->working_hr }}</td>
                                        <td>{{ $PaymentType->rate }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('hrm.payment_types.show',$PaymentType->id) }}">Show</a>
                                            @can('PaymentType-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.payment_types.edit',$PaymentType->id) }}">Edit</a>
                                            @endcan
                                            @can('PaymentType-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.payment_types.destroy', $PaymentType->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $payment_types->render() !!}
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