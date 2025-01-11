@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Jobapplied-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.job_applieds.create') }}"> Create New jobapplied</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">jobapplieds Management</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>title</th>
                                        <th>Candidate</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>status</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobapplieds as $key => $jobapplied)
                                    <tr>
                                        <td>@if(!empty($jobapplied->jobpost->job_code)) {{ $jobapplied->jobpost->job_code }}@endif</td>
                                        <td>@if(!empty($jobapplied->jobpost->job_title)){{ $jobapplied->jobpost->job_title }}@endif</td>
                                        <td>{{ $jobapplied->name }}</td>
                                        <td>{{ $jobapplied->email }}</td>
                                        <td>{{ $jobapplied->phone }}</td>
                                        <td>{{ $jobapplied->status }}</td>
                                        <td>
                                        <a class="btn btn-info" href="{{ asset('/upload/resume/'.$jobapplied->resume) }}" download>resume</a>
                                        <a class="btn btn-info" target="_blank" href="{{ asset('/upload/cover_letter/'.$jobapplied->cover_letter) }}" download>cover letter</a>
                                           
                                            <a class="btn btn-primary" href="{{ route('hrm.job_applieds.edit',$jobapplied->id) }}">Edit</a>
                                            
                                            @can('jobapplied-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['hrm.job_applieds.destroy', $jobapplied->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $jobapplieds->render() !!}
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