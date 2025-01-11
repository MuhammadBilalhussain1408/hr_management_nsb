@extends('layouts.app-input')
@section('content')

<div class="page-content" id="app">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('content-edit')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/contents')}}">content</a></li>
                            <li class="breadcrumb-item active">Edit  </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Edit  </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.contents.index') }}"> Back</a>
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
                        {!! Form::model($content, ['method' => 'PATCH','route' => ['hrm.contents.update',
                        $content->id], 'files' => true, 'enctype' =>'multipart/form-data']) !!}

                        <div class="row form-group">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Menu:</strong>
                                    <select class="form-control input-border-bottom" id="menu_id" name="menu_id" onchange="chngdepartment(this.value);">
                                        @if($content->menus)    
                                        <option value="{{$content->menus->id}}">{{$content->menus->name}}</option>
                                        @endif
                                        @foreach($menus as $menu)
                                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="submenu_id" class="placeholder">Submenu </label>
                                    <select class="form-control input-border-bottom" id="submenu_id" name="submenu_id"  onchange="chngdesignation(this.value);">
                                    @if($content->submenus)
                                    <option value="{{$content->submenus->id}}">{{$content->submenus->name}}</option> 
                                    @endif   
                                    <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Name</label>
                                    <input id="name" type="text" class="form-control input-border-bottom" name="name" value="{{$content->name}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label for="meta_title" class="placeholder">Meta title</label>
                                    <input id="meta_title" type="text" class="form-control input-border-bottom" required="" name="meta_title" value="{{$content->meta_title}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="meta_keywords" class="placeholder">Meta keywords</label>
                                    <input id="meta_keywords" type="text" class="form-control input-border-bottom" required="" name="meta_keywords" value="{{$content->meta_keywords}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder">Meta Descriptions</label>
                                    <textarea rows="5" class="form-control" name="meta_des">{{$content->meta_des}} </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="editor" class="placeholder"> Descriptions</label>
                                    <textarea rows="5" class="form-control" id="body" name="body">{{$content->body}} </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required=""
                                        name="status">
                                        <option value="">Select</option>
                                        @if($content->status == 'Enable')
                                        <option value="Enable" selected="">Enable</option>
                                        <option value="Disable">Disable</option>
                                        @else
                                        <option value="Enable">Enable</option>
                                        <option value="Disable" selected="">Disable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Your Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Your Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image2" value="">
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
    <script>
        function chngdepartment(empid) {

            $.ajax({
                type: 'GET',
                url: '/hrm/get_submenu/' + empid,
                cache: false,
                success: function(response) {
                    console.log(response);
                    var obj_data = JSON.parse(response);
                    var output = '';
                    output += '<option value = "0"> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.id + '" selected> ' + data.name +
                            '</option>';
                    });
                    $('#submenu_id').html(output);
                    // document.getElementById("title").innerHTML = response;

                }
            });
        }
      
    </script>
      <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
    @endsection