@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('employee-create')
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
                                    <strong>Employee Document</strong>
                                    <select class="form-control input-border-bottom" id="emp_id" required="" name="emp_id">
                                        <option value="">&nbsp;</option>
                                        @forelse($emps as $emp)
                                        <option value="{{$emp->id}}">{{$emp->fname}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label>Select Document</label>

                                <select class="form-control" id="scan_doc1" name="scan_doc1" onchange="checkscsnf(this.value);" aria-invalid="false">
                                    <option value="" selected="" disabled=""> &nbsp;</option>
                                    <option value="pr_add_proof">Proof Of Correspondence Address </option>
                                    <option value="passport_proof">Passport Document </option>
                                </select>
                                <input type="hidden" id="scan_doc1_img" name="scan_doc1_img" value="">

                                <div class="text-center">
                                    <div class="scan-hd">
                                        <h3>RTW Evidence Scans-1</h3>
                                    </div>

                                    <div class="scan-body" style="background: #edecec;">
                                        <embed name="imgeid" id="imgeid" width="50%" src="">
                                        <div id="scan_ne_id">
                                            <img name="imgeidnew" id="imgeidnew" width="50%" src="">
                                        </div>
                                    </div>
                                    <a class="btn" id="scan_doc1_url" href="" download>download</a>
                                </div>
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
    //     function checkscsnf(val) {
    //         var emp_id = $("#emp_id").val();
    //         $.ajax({
    //             type: 'GET',
    //             url: '/hrm/get_emp_doc/' + emp_id + '/' + val,
    //             cache: false,
    //             success: function(response) {
    //                 var obj = jQuery.parseJSON(response);
    //                 //  console.log(val);
    //                 if (val == 'passport_proof') {
    //                     var gg = "/upload/image/" + obj.passport_proof;
    //                     console.log(gg);

    //                     $("#imgeid").attr("src", gg);
    //                     $("#imgeidnew").attr("src", gg);
    //                     $("#scan_doc1_url").attr("href", gg);
    //                     $("#scan_doc1_img").val(obj.passport_proof);
    //                 } else {
    //                     var gg = "/upload/image/" + obj.pr_add_proof;

    //                     $("#imgeid").attr("src", gg);
    //                     $("#imgeidnew").attr("src", gg);
    //                     $("#scan_doc1_url").attr("href", gg);
    //                     $("#scan_doc1_img").val(obj.pr_add_proof);
    //                 }
    //             }
    //         });
    //     }
    // </script>
    <script>
    function checkscsnf(val) {
        var emp_id = $("#emp_id").val();
        $.ajax({
            type: 'GET',
            url: '/hrm/get_emp_doc/' + emp_id + '/' + val,
            cache: false,
            success: function(response) {
                var obj = jQuery.parseJSON(response);

                if (val == 'passport_proof') {
                    var gg = "/upload/image/" + obj.passport_proof;

                    if (obj.passport_proof.endsWith('.pdf')) {
                        $("#imgeid").attr("src", gg); // Hide the image
                        $("#scan_ne_id").hide(); // Hide the image container
                        $("#imgeidnew").attr("src", ""); // Show the PDF using the embed tag
                    } else {
                        $("#imgeid").attr("src", ""); // Show the image
                        $("#imgeidnew").attr("src", gg); // Hide the PDF
                        $("#scan_ne_id").show(); // Show the image container
                    }

                    $("#scan_doc1_url").attr("href", gg);
                    $("#scan_doc1_img").val(obj.passport_proof);
                } else {
                    var gg = "/upload/image/" + obj.pr_add_proof;

                    if (obj.pr_add_proof.endsWith('.pdf')) {
                        $("#imgeid").attr("src", gg); // Hide the image
                        $("#scan_ne_id").hide(); // Hide the image container
                        $("#imgeidnew").attr("src", ""); // Show the PDF using the embed tag
                    } else {
                        $("#imgeid").attr("src", ""); // Show the image
                        $("#imgeidnew").attr("src", gg); // Hide the PDF
                        $("#scan_ne_id").show(); // Show the image container
                    }

                    $("#scan_doc1_url").attr("href", gg);
                    $("#scan_doc1_img").val(obj.pr_add_proof);
                }
            }
        });
    }
</script>
    @endsection