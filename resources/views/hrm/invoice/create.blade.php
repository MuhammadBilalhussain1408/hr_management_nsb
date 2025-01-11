@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('invoice-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/invoices')}}">invoices</a></li>
                            <li class="breadcrumb-item active">Create New invoice </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New invoice </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.invoices.index') }}"> Back</a>
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
                        {!! Form::open(array('route' => 'hrm.invoices.store','method'=>'POST', 'id'=>'regForm',
                        'files'=>'true', 'enctype' =>'multipart/form-data')) !!}

                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Organization:</strong>
                                    <select class="form-control input-border-bottom" id="organization_id" required="" name="organization_id">
                                        <option value="">Select</option>
                                        @foreach($organizations as $org)
                                        <option value="{{$org->id}}">{{$org->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Service:</strong>
                                    <select class="form-control input-border-bottom" id="service_id" required="" name="service_id" onchange="chngdepartmentdesp(this.value);">
                                        <option value="">Select</option>
                                        @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Amount</label>
                                    <input id="amount" type="text" class="form-control input-border-bottom" name="amount" value="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Bill Date</label>
                                    <input id="amount" type="date" class="form-control input-border-bottom" name="bill_date" value="">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <label for="details" class="placeholder"> Descriptions</label>
                                    <textarea rows="5" class="form-control" id="details" name="body"> </textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Bank :</strong>
                                    <select class="form-control input-border-bottom" id="bank_id" required="" name="bank_id" onchange="bankcode(this.value);">
                                        <option value="">Select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Bank code</label>
                                    <select class="form-control input-border-bottom" id="bank_code" required="" name="bank_code" onchange="bankcode(this.value);">
                                        <option value="">Select</option>
                                        
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group">
                                    <label class="placeholder">Account no</label>
                                    <input id="account_no" type="text" class="form-control input-border-bottom" name="account_no" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control input-border-bottom" id="status" required="" name="status">
                                        <option value="">&nbsp;</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Not Paid" selected="">Not Paid</option>

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
        function chngdepartmentdesp(serid) {
            var soc = $("#service_id option:selected").val();

            $.ajax({
                type: 'GET',
                url: '/hrm/get_ser/' + serid ,
                cache: false,
                success: function(response) {
                    console.log(response);
                    var obj_data = jQuery.parseJSON(response);

                    $.each(obj_data, function(i, obj) {
                        var details = obj.details;
                        var amount = obj.amount;

                        $("#details").val(details);
                        $("#amount").val(amount);
                    });

                  //  $("#details").attr("readonly", true);

                }
            });
        };
        function bankcode(bank_id) {

            $.ajax({
                type: 'GET',
                url: '/hrm/bank_code/' + bank_id ,
                cache: false,
                success: function(response) {
                  //  console.log(response);
                    var obj_data = JSON.parse(response);
                    var output = '';
                    output += '<option value = "0"> Selected </option>';
                    $.each(obj_data, function(i, data) {
                        output += '<option value = "' + data.code + '" selected> ' + data.code +
                            '</option>';
                    });
                    $('#bank_code').html(output);
                    // document.getElementById("title").innerHTML = response;

                }
            });
        }

    </script>
   
    @endsection