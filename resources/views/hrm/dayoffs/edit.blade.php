@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('dayoff-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/dayOff')}}">Users</a></li>
                            <li class="breadcrumb-item active">Edit User </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit User </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.dayoffs.index') }}"> Back</a>
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
                        {!! Form::model($dayOff, ['method' => 'PATCH','route' => ['hrm.dayoffs.update',
                        $dayOff->id]]) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Department:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control input-border-bottom" id="department_id" name="department_id" onchange="chngdepartment(this.value);">
                                        <option value="{{$dayOff->department_id}}">{{$dayOff->department->name}}</option>
                                        @foreach($departments as $dep)
                                        <option value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Designation </label>
                                    <select class="form-control input-border-bottom" id="designation_id" name="designation_id" onchange="chngdesignation(this.value);" required>
                                        <option value="{{$dayOff->designation_id}}" selected="">{{$dayOff->designation->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="placeholder">Sift code </label>
                                    <select class="form-control input-border-bottom" id="dayOff_code" name="dayOff_id">
                                        <option value="{{$dayOff->shift_id}}" selected="" disabled="">{{$dayOff->shift->shift_code}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-10">
                                <div class="form-group">
                                    <h6>Day off</h6>
                                    @if($dayOff->monday == 1)
                                    <input type="checkbox" class="col-md-2" name="monday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="monday" value="0" checked>
                                    @endif
                                    <label>Monday</label>
                                    @if($dayOff->thursday == 1)
                                    <input type="checkbox" class="col-md-2" name="tuesday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="tuesday" value="0" checked>
                                    @endif
                                    <label>Tuesday</label>
                                    @if($dayOff->thursday == 1)
                                    <input type="checkbox" class="col-md-2" name="wednesday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="wednesday" value="0" checked>
                                    @endif
                                    <label>Wednesday</label>
                                    @if($dayOff->thursday == 1)
                                    <input type="checkbox" class="col-md-2" name="thursday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="thursday" value="0" checked>
                                    @endif
                                    <label>Thursday</label>
                                    @if($dayOff->friday == 1)
                                    <input type="checkbox" class="col-md-2" name="friday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="friday" value="0" checked>
                                    @endif
                                    <label>Friday</label>
                                    @if($dayOff->saturday == 1)
                                    <input type="checkbox" class="col-md-2" name="saturday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="saturday" value="0" checked>
                                    @endif
                                    <label>Saturday</label>
                                    @if($dayOff->sunday == 1)
                                    <input type="checkbox" class="col-md-2" name="sunday" value="1">
                                    @else
                                    <input type="checkbox" class="col-md-2" name="sunday" value="0" checked>
                                    @endif
                                    <label>Sunday</label>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
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
    <script>
        function calculateDays() {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var fromdate = new Date(from_date);
            var todate = new Date(to_date);
            var diffDays = (todate.getDate() - fromdate.getDate()) + 1;
            $("#num_of_day").val(diffDays);
        }
    </script>
    @endsection