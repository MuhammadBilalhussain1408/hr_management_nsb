@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('attendance-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/attendances')}}">attendance</a></li>
                            <li class="breadcrumb-item active">Create New attendance </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New attendance </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.attendances.index') }}"> Back</a>
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
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        
                        {!! Form::open(array('route' => 'hrm.file_upload','method'=>'POST', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}
                        <div class="row form-group">

                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="placeholder">File To Upload (.csv) </label>

                                <div class="col-md-12">
                                    <input id="amount" type="file" class="form-control" name="file">

                                    @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <span>*Document Size Less Than 2 MB </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->
    @include('layouts.footer')

    @endsection