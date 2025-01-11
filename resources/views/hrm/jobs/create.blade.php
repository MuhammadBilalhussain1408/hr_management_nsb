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
                        {!! Form::open(array('route' => 'hrm.jobs.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <label for="type" class="placeholder">Select Job Type</label>
                                    <select id="type" type="text" class="form-control input-border-bottom" required="" name="type" onchange="jobcheck(this.value);">
                                        <option value="">&nbsp;</option>
                                        <option value="new">New</option>
                                        <option value="exiting">Existing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="newcust" style="display:none;">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-soc-code" class="placeholder">SOC Code</label>
                                    <input id="socnew" type="text" class="form-control input-border-bottom" name="socnew" value="">

                                </div>
                            </div>

                            <div class="col-md-4" id="oldcust" style="display:none;">
                                <div class=" form-group">
                                    <label for="soc" class="placeholder">SOC Code</label>
                                    <select id="socold" type="text" class="form-control input-border-bottom" name="socold">
                                        <option value="">&nbsp;</option>
                                        @forelse($jobs as $job)
                                        <option value="{{$job->soc_code}}">{{$job->soc_code}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="job" class="placeholder">Department</label>
                                    <input id="department" type="text" class="form-control input-border-bottom" required="" name="department" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-job-title" class="placeholder">Job Title </label>
                                    <input id="inputFloatingLabel-job-title" type="text" class="form-control input-border-bottom" required="" name="job_title" value="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input id="skil_set" type="hidden" class="form-control input-border-bottom" required="" name="skil_set" value="dfgd">

                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Job Descriptions</label>
                                    <textarea rows="5" class="form-control" id="demo1" name="job_des"> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        <option value="">&nbsp;</option>
                                        <option value="Enable" selected="">Enable</option>
                                        <option value="Disable">Disable</option>

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