@extends('layouts.form_app')
@section('content')
@include('layouts.leftbar')
<div class="page-content">
    <div class="container-fluid"><!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12"><div class="page-title-box"><div class="float-right"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{('/permissions')}}">Permission</a></li><li class="breadcrumb-item active">Create New Permission </li></ol></div><h4 class="page-title"> Create New Permission </h4></div></div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                        <div class="form-group"><label class="col-form-label">Name</label>
                            <div class="">
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">Create Permission</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- end page content -->
    @include('layouts.footer')
    @endsection