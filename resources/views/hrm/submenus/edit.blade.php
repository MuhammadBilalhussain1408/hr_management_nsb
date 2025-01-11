@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('submenu-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/submenus')}}">submenu</a></li>
                            <li class="breadcrumb-item active">Edit submenu </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit submenu </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.submenus.index') }}"> Back</a>
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
                        {!! Form::model($submenu, ['method' => 'PATCH','route' => ['hrm.submenus.update',
                        $submenu->id], 'files' => true, 'enctype' =>'multipart/form-data']) !!}


                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>menu:</strong>
                                    <select class="form-control input-border-bottom" id="menu_id" required=""
                                        name="menu_id">
                                        <optgroup label="Current">
                                            <option value="{{$submenu->menu->id}}">
                                                {{$submenu->menu->name}}</option>
                                        </optgroup>
                                        <optgroup>
                                            <option value="">Select</option>
                                            @foreach($menus as $dep)
                                            <option value="{{$dep->id}}">{{$dep->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Name</label>
                                    <input id="name" type="text" class="form-control input-border-bottom" name="name" value="{{ $submenu->name }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="meta_title" class="placeholder">Meta title</label>
                                    <input id="meta_title" type="text" class="form-control input-border-bottom" required="" name="meta_title" value="{{ $submenu->meta_title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="meta_keywords" class="placeholder">Meta keywords</label>
                                    <input id="meta_keywords" type="text" class="form-control input-border-bottom" required="" name="meta_keywords" value="{{ $submenu->meta_keywords }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Meta Descriptions</label>
                                    <textarea rows="5" class="form-control" name="meta_des">{{ $submenu->meta_des }} </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder"> Descriptions</label>
                                    <textarea rows="5" class="form-control" id="demo1" name="body">{{ $submenu->body }} </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        <option value="{{ $submenu->status }}" @selected(old('status')==$submenu->status)>
                                            {{ $submenu->status }}
                                        </option>
                                        <option value="Enable">Enable</option>
                                        <option value="Disable" selected="">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Your Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" value="{{ $submenu->image }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Your Image</label>
                                    <img class="form-control-file" src="{{ asset('storage/upload/submenu/'.$submenu->image) }}">
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