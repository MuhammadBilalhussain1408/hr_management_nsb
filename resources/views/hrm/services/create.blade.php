@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('service-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/services')}}">services</a></li>
                            <li class="breadcrumb-item active">Create New service </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New service </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.services.index') }}"> Back</a>
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
                        {!! Form::open(array('route' => 'hrm.services.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Name</label>
                                    <input id="name" type="text" class="form-control input-border-bottom" name="name" value="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="meta_title" class="placeholder">Meta title</label>
                                    <input id="meta_title" type="text" class="form-control input-border-bottom" required="" name="meta_title" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="meta_keywords" class="placeholder">Meta keywords</label>
                                    <input id="meta_keywords" type="text" class="form-control input-border-bottom" required="" name="meta_keywords" value="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Meta Descriptions</label>
                                    <textarea rows="5" class="form-control" name="meta_des"> </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Description</label>
                                    <textarea rows="5" class="form-control" id="demo1" name="body"> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Service Charge</label>
                                    <input id="amount" type="text" class="form-control input-border-bottom" name="amount" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Service Description</label>
                                    <textarea rows="5" class="form-control" id="details" name="details"> </textarea>
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
                                        <option value="Disable" >Disable</option>

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
        CKEDITOR.replace('body');
    </script>
    @endsection