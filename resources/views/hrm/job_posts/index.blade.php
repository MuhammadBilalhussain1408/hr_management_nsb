@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('jobpost-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.job_posts.create') }}"> Create New jobpost</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">job_post Management</h5>
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
                                        <th>link</th>
                                        <th>SOC Code</th>
                                        <th>Department</th>
                                        <th>Job Code</th>
                                        <th>Status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($job_posts as $key => $jobpost)
                                    <tr>
                                        <td>{{ $jobpost->id }}</td>
                                        <td>{{ $jobpost->job->job_title }}</td>
                                        <td><a href="{{URL::to('/career/'.$jobpost->slug)}}" class="text-success" target="_blank"><span> {{URL::to('/career/'.$jobpost->slug)}}</span></a></td>
                                        <td>{{ $jobpost->job->soc_code }}</td>
                                        <td>{{ $jobpost->department }}</td>
                                        <td>{{ $jobpost->job_code }}</td>
                                        <td>{{ $jobpost->status }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{URL::to('/career/'.$jobpost->slug)}}" target="_blank">Show</a>
                                            @can('jobpost-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.job_posts.edit',$jobpost->id) }}">Edit</a>
                                            @endcan
                                            @can('jobpost-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.job_posts.destroy', $jobpost->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $job_posts->render() !!}
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