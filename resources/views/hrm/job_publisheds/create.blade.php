@extends('layouts.app-wizard')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('jobPublished-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/job_publisheds')}}">jobPublished</a></li>
                            <li class="breadcrumb-item active">Create New jobPublished </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New jobPublished </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.job_publisheds.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.job_publisheds.store','method'=>'POST', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}

                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="inputFloatingLabel-soc-code" class="placeholder">SOC Code</label>
                                    <select id="soc" class="form-control input-border-bottom" required="" name="soc_code" onchange="chngdepartment(this.value);">
                                        <option value="">&nbsp;</option>
                                        @foreach($jobs as $job)
                                        <option value="{{$job}}">{{$job}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="title" class="placeholder">Job Title</label>
                                    <select id="title" class="form-control input-border-bottom" required="" name="job_id" onchange="chngdepartmentdesp(this.value);">
                                        <option value="" selected="" disabled=""> &nbsp;</option>
                                    </select>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label for="department" class="placeholder">Department</label>
                                    <input id="department" type="text" class="form-control input-border-bottom" required="" name="department" value="" />

                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-12">
                                <label for="job_desc" class="placeholder">Job Description</label>
                                <textarea id="job_desc" name="job_des" type="text" rows="5" class="form-control ckeditor" style="visibility: hidden; display: none;">  </textarea>
                            </div>
                        </div>
                        <fieldset>
                            <div class="repeater-custom-show-hide">

                                <div data-repeater-list="checklist">
                                    <div data-repeater-item="">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="label_fname">Published websites url/link </label>
                                                <span class="text-danger"> *</span>
                                                <input class="form-control input-border-bottom" id="checklist" name="checklist[0][name]">

                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="inputFloatingLabel-jobs" class="placeholder">
                                                        Upload Document
                                                    </label>
                                                    <input id="inputFloatingLabel-jobs" type="file" class="form-control input-border-bottom" name="checklist[0][image]">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-4"><span data-repeater-delete="" class="btn btn-danger btn-md"><span class="fa fa-times"></span>
                                                </span>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <span data-repeater-create="" class="btn btn-success btn-md"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        <option value="">&nbsp;</option>
                                        <option value="Enable" selected="">Enable</option>
                                        <option value="Disable">Disable</option>

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
    <script>
        function chngdepartment(empid) {

            $.ajax({
                type: 'GET',
                url: '/hrm/job_code/' + empid,
                cache: false,
                success: function(response) {
                    console.log(response);
                    var obj_data = JSON.parse(response);
                    var output = '';
                    output += '<option value = "0" selected> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.id + '"> ' + data.job_title +
                            '</option>';
                    });
                    $('#title').html(output);
                    // document.getElementById("title").innerHTML = response;

                }
            });
        }

        function chngdepartmentdesp(empid) {
            var soc = $("#soc option:selected").val();

            $.ajax({
                type: 'GET',
                url: '/hrm/job_empid/' + empid + '/' + soc,
                cache: false,
                success: function(response) {
                    console.log(response);
                    var obj_data = jQuery.parseJSON(response);




                    $.each(obj_data, function(i, obj) {
                        var job_desc = obj.job_des;
                        var department = obj.department;

                        $("#job_desc").val(job_desc);
                        $("#skil_set").val(obj.skil_set);
                        $("#department").val(department);
                    });

                    CKEDITOR.instances['job_desc'].setData(job_desc);
                    $("#department").attr("readonly", true);

                }
            });
        }

        function trade_epmloyee(val) {
            if (val == 'Others') {
                document.getElementById("criman_new").style.display = "block";
                $("#other").prop('required', true);

            } else {
                document.getElementById("criman_new").style.display = "none";
                $("#other").prop('required', false);
            }

        }
    </script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    @endsection