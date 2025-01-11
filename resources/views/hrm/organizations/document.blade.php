@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('organization-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm.checklists')}}">checklists</a></li>
                            <li class="breadcrumb-item active">Create New checklist </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New checklist </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.checklists.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.doc_search','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong>Organisation Document</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="checklist_id">
                                        <option value="">&nbsp;</option>
                                        @forelse($checklists as $doc)
                                        <option value="{{$doc->id}}">{{$doc->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> <br>
                        </div>
                        {!! Form::close() !!}
                        <div class="row">
                             @if($doc)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <embed src= "{{asset('/upload/doc/'. $doc->image )}}" width= "100%" height= "375">
                            </div>
                            <a class="btn" id="scan_doc1_url" href="{{asset('/upload/doc/'. $doc->image )}}" download>download</a>
                             @endif
                        </div>
                    </div>
                </div>
               
            </div>
        </div><!-- container -->
        @endcan
    </div><!-- end page content -->
    @include('layouts.footer')
    @endsection