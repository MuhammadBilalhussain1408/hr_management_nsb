@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('jobPublished-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/job_publisheds')}}">job_published</a></li>
                            <li class="breadcrumb-item active">Edit jobPublished </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit Job post </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.job_publisheds.index') }}"> Back</a>
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
                   
                        {!! Form::open(array('route' => ['hrm.job_publisheds.update', $jobPublished->id],'method'=>'PATCH', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}

                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-soc-code" class="placeholder">SOC Code</label>
                                    <select id="soc" class="form-control input-border-bottom" required="" name="soc_code">
                                        <option value="{{$jobPublished->soc_code}}">{{$jobPublished->soc_code}}</option>
                                    </select>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="title" class="placeholder">Job Title</label>
                                    <select id="title" class="form-control input-border-bottom" required="" name="job_id">
                                        <option value="{{$jobPublished->job->id}}" selected="" disabled=""> {{$jobPublished->job->job_title}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="department" class="placeholder">Department</label>
                                    <input id="department" type="text" class="form-control input-border-bottom" required="" name="department" value="{{$jobPublished->department}}" />
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-12">
                                <label for="job_desc" class="placeholder">Job Description</label>
                                <textarea id="job_desc" name="job_des" type="text" rows="5" class="form-control ckeditor"> {{$jobPublished->job_des}} </textarea>
                            </div>

                        </div>
                        <fieldset>
                            <div class="repeater-custom-show-hide">

                                <div data-repeater-list="checklist">
                                    @forelse($job_published_link as $link)
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="label_fname">Published websites url/link </label>
                                            <span class="text-danger"> *</span>
                                            <input class="form-control input-border-bottom" id="checklist" name="checklist[0][name]" value="{{$link->link}}">

                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="inputFloatingLabel-jobs" class="placeholder">
                                                    Upload Document
                                                </label>
                                                <input id="inputFloatingLabel-jobs" type="file" class="form-control input-border-bottom" name="checklist[0][image]" value="{{$link->image}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <a href="{{asset('/storage/upload/job_published/'.$link->image)}}" target="_blank" class=" btn btn-success btn-md mt-4" download="">
                                        <span class="fa fa-download"></span></a>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                    <div data-repeater-item="">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="label_fname">Published websites url/link </label>
                                                <span class="text-danger"> *</span>
                                                <input class="form-control input-border-bottom" id="checklist" name="checklist[0][name]">

                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="inputFloatingLabel-jobs" class="placeholder">
                                                        Upload Document
                                                    </label>
                                                    <input id="inputFloatingLabel-jobs" type="file" class="form-control input-border-bottom" name="checklist[0][image]">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-4"><span data-repeater-delete="" class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                </span>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <span data-repeater-create="" class="btn btn-success btn-md"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        @if($jobPublished->status == 'Enable')
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    @endsection