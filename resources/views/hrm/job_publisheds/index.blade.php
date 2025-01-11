@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('jobPublished-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.job_publisheds.create') }}"> Create New jobPublished</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">job_published Management</h5>
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
                                        <th>Title</th>
                                        <th>SOC Code</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($job_publisheds as $key => $jobPublished)
                                    <tr>
                                        <td>{{ $jobPublished->id }}</td>
                                        <td>{{ $jobPublished->job->job_title }}</td>
                                        <td>{{ $jobPublished->soc_code }}</td>
                                        <td>{{ $jobPublished->department }}</td>
                                        <td>{{ $jobPublished->status }}</td>
                                        <td>
                                            @can('jobPublished-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.job_publisheds.edit',$jobPublished->id) }}">Edit</a>
                                            @endcan
                                            @can('jobPublished-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.job_publisheds.destroy', $jobPublished->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $job_publisheds->render() !!}
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