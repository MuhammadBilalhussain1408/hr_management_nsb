@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('bankcode-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/bankcodes')}}">bankcodes</a></li>
                            <li class="breadcrumb-item active">Edit bankcode </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit bankcode </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.bankcodes.index') }}"> Back</a>
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
                        {!! Form::model($bankcode, ['method' => 'PATCH','route' => ['hrm.bankcodes.update',
                        $bankcode->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Bank name</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="bank_id" required="" name="bank_id">
                                        <optgroup label="Current">
                                            <option value="{{$bankcode->bank->id}}">{{$bankcode->bank->name}}</option>
                                        </optgroup>
                                        <optgroup>
                                            <option value="">Select</option>
                                            @foreach($banks as $bn)
                                            <option value="{{$bn->id}}">{{$bn->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Short code:</strong>
                                    {!! Form::text('code', null, array('placeholder' => 'Short code','class' =>
                                    'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        @if($bankcode->status == 'Enable')
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
    @endsection