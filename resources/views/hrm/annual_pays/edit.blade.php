@extends('layouts.app-wizard')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('AnnualPay-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/annual_pays')}}">AnnualPays</a></li>
                            <li class="breadcrumb-item active">Create New AnnualPay </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New AnnualPay </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.annual_pays.index') }}"> Back</a>
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

                        {!! Form::model($annual_pay, ['method' => 'PATCH','route' => ['hrm.annual_pays.update',
                        $annual_pay->id]]) !!} 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                <fieldset>
                                    <div class="repeater-custom-show-hide">
                                        <div data-repeater-list="car">

                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <strong>Paygroup:</strong>
                                                            <select class="form-control input-border-bottom" id="status" required="" name="car[0][pay_group_id]">
                                                                <option value="">&nbsp;</option>
                                                                @foreach($paygroups as $pay)
                                                                <option value="{{$pay->id}}">{{$pay->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <strong>Annual Pay:</strong>
                                                            <input type="text" name="car[0][annual_pay]" placeholder="Answer" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <strong>Annual Pay:</strong>
                                                            <input type="text" name="car[0][annual_pay2]" placeholder="Point" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <span data-repeater-delete="" class="btn btn-danger btn-md">
                                                            <span class="fa fa-times"></span>
                                                        </span>
                                                        <span data-repeater-create="" class="btn btn-success btn-md">
                                                            <span class="fa fa-plus"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div><!-- container -->
    @endcan
</div><!-- end page content -->
</div>
@include('layouts.footer')
@endsection