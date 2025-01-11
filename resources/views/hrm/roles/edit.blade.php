
@extends('layouts.app-input')
@section('content')
<div class="page-content">
    <div class="container-fluid"><!-- Page-Title -->
         @can('role-edit')
        <div class="row">
            <div class="col-sm-12"><div class="page-title-box"><div class="float-right"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{('/users')}}">Users</a></li><li class="breadcrumb-item active">Create New Role </li></ol></div><h4 class="page-title"> Create New Role </h4></div></div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.roles.index') }}"> Back</a>
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
                        {!! Form::model($role, ['method' => 'PATCH','route' => ['hrm.roles.update', $role->id]]) !!}
                        <div class="form-group"><label class="col-form-label">Name</label>
                            <div class="">
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Select Permission
                                    <div class="checkbox2 checkbox-info">
                                        <input type="checkbox" id="select_all"/> 
                                        <label class="col-form-label">
                                            Seleccted All
                                        </label>
                                    </div>
                                </label>
                            </div>
                            <div class=" form-group">
                                @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'checkbox')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                                <p class="help-block"></p>
                                @if($errors->has('permission'))
                                <p class="help-block">
                                    {{ $errors->first('permission') }}
                                </p>
                                @endif
                            </div>
                        </div>
                       <!-- <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Select Permission
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" id="select_all2"/> 
                                        <label class="col-form-label">
                                            Selecct All
                                        </label>
                                    </div>
                                </label>
                            </div>
                            <div class=" form-group">
                                @foreach($permission as $value)
                                <div class="checkbox checkbox-inline checkbox-info">
                                    <input class="checkbox2" type="checkbox" name="permission[]" value="{{ $value->id }}">
                                    <label for="inlineCheckbox1">{{ $value->name }} </label>
                            
                                </div>
                                @endforeach
                                <p class="help-block"></p>
                                @if($errors->has('permission'))
                                <p class="help-block">
                                    {{ $errors->first('permission') }}
                                </p>
                                @endif
                            </div>
                        </div>-->
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Update</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- container -->
        @endcan
        @include('layouts.footer')
    </div><!-- end page content -->
    <script>
        var select_all = document.getElementById("select_all"); //select all checkbox
        var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

        //select all checkboxes
        select_all.addEventListener("change", function(e) {
            for (i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = select_all.checked;
            }
        });

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function(e) { //".checkbox" change 
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if (this.checked == false) {
                    select_all.checked = false;
                }
                //check "select all" if all checkbox items are checked
                if (document.querySelectorAll('.checkbox:checked').length == checkboxes.length) {
                    select_all.checked = true;
                }
            });
        }
    </script>
    @endsection
