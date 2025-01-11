@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
       
        <div class="row">
            <div class="col-sm-12">
                
                <div class="page-title-box">
                     @can('invoice-create') <a class="btn btn-success" href="{{ route('hrm.invoices.create') }}"> Create New invoice</a> @endcan
                </div>
                
            </div>
        </div><!-- end page title end breadcrumb -->
       
         @can('invoice-list')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">invoices Management</h5>
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
                                        <th>Invoice no</th>
                                        <th>Amount</th>
                                        <th>Description Keywords</th>
                                        <th>Bill date</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $key => $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->amount }}</td>
                                        <td>{{ $invoice->body }}</td>
                                        <td>{{ $invoice->bill_date }}</td>
                                        <td>{{ $invoice->status }}</td>
                                        <td>
                                            @can('invoice-edit')
                                            <a class="btn btn-primary" href="{{ route('hrm.invoices.edit',$invoice->id) }}"><span class="fa fa-edit"></span></a>
                                            @endcan
                                            @can('invoice-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.invoices.destroy', $invoice->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger"> <span class="fa fa-trash"></span></button>
                                            {!! Form::close() !!}
                                            @endcan
                                            <a class="btn btn-primary" href="{{ route('hrm.invoices.show',$invoice->id) }}"><span class="fa fa-file-pdf"></span></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $invoices->render() !!}
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