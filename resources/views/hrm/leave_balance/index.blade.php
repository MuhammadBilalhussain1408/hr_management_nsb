@extends('layouts.app-datatables')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Leave-allocation-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">Leave Balance
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                       
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
                                        <th>Emp code</th>
                                        <th>Emp name </th>
                                        <th>leave type</th>
                                        <th>Leave balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($LeaveAllocations as $key => $lva)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $lva->emp->code }}</td>
                                        <td>{{ $lva->emp->fname }}</td>
                                        <td>{{ $lva->leave_types->name }}</td>
                                        <td>{{$lva->max_no - $lva->leave_hand}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $LeaveAllocations->render() !!}
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