@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('job-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/jobs')}}">jobs</a></li>
                            <li class="breadcrumb-item active">Create New job </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New job </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.jobs.index') }}"> Back</a>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        {!! Form::model($job, ['method' => 'PATCH','route' => ['hrm.jobs.update',
                        $job->id]]) !!}
                        <div class="row">
                            <div class="col-md-4" id="newcust">
                                <div class=" form-group">
                                <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <label for="inputFloatingLabel-soc-code" class="placeholder">SOC Code</label>
                                    <input id="socnew" type="text" class="form-control input-border-bottom" name="soc_code" value="{{$job->soc_code}}" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="department" class="placeholder">Department</label>
                                    <input id="department" type="text" class="form-control input-border-bottom" required="" name="department" value="{{$job->department}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-job-title" class="placeholder">Job Title </label>
                                    <input id="inputFloatingLabel-job-title" type="text" class="form-control input-border-bottom" required="" name="job_title" value="{{$job->job_title}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Job Descriptions</label>
                                    <textarea rows="5" class="form-control" id="demo1" name="job_des">{{$job->job_des}} </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        @if($job->status == 'Enable')
                                        <option value="Enable" selected="">Enable</option>
                                        <option value="Disable">Disable</option>
                                        @else
                                        <option value="Enable">Enable</option>
                                        <option value="Disable" selected="">Disable</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->
    @include('layouts.footer')
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('job_des');
    </script>
    <script>
        function jobcheck(val) {
            if (val == 'new') {
                document.getElementById("newcust").style.display = "block";
                document.getElementById("oldcust").style.display = "none";
                $("#socnew").prop('required', true);
                $("#socold").prop('required', false);
            } else {
                document.getElementById("newcust").style.display = "none";
                document.getElementById("oldcust").style.display = "block";
                $("#socold").prop('required', true);
                $("#socnew").prop('required', false);
            }

        }
    </script>
    @endsection