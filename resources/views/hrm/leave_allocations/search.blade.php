@extends('layouts.app-input')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Leave-allocation-create')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/leave_rules')}}">leave_rule</a></li>
                            <li class="breadcrumb-item active">Create New leave_rule </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Create New leave allocation </h4>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('hrm.leave_allocations.index') }}"> Back</a>
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

                        {!! Form::open(array('route' => 'hrm.leave_allocations.store','method'=>'POST')) !!}
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 1, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Emoployee type</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Leave type</th>
                                        <th>Maximum no</th>
                                        <th>Leave in hand</th>
                                        <th class="dt-no-sorting">Affective year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lrule as $rule)
                                    @foreach ($employees as $key => $emp)
                                    <tr>
                                        <td>
                                            <div class=" form-group">
                                                <div class="checkbox checkbox-inline checkbox-info">
                                                    <input class="checkbox" type="checkbox" name="car[{{ $emp->id}}][employee_id]" value="{{ $emp->id }}" required>
                                                </div>
                                                <p class="help-block"></p>
                                                @if($errors->has('employee_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('employee_id') }}
                                                </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td>@if($emp->emp_type){{ $emp->emp_type->name }}@endif</td>
                                        <td>{{ $emp->code }}</td>
                                        <td>{{ $emp->fname }} {{ $emp->mid_name }} {{ $emp->lname }}</td>
                                        <td>@if($rule->leave_types){{ $rule->leave_types->name }}@endif</td>
                                        <td>
                                            <div class="form-group ">
                                                <input id="organization_id" type="hidden" class="form-control " required="" name="organization_id" value="{{  Auth::user()->org->id }}">
                                               @if( $emp->emp_type)
                                                <input id="employee_type_id" type="hidden" class="form-control " required="" name="employee_type_id" value="{{  $emp->emp_type->id }}">
                                                @else
                                                <input id="employee_type_id" type="hidden" class="form-control " required="" name="employee_type_id" value="{{  $emp->employee_type_id}}">
                                               @endif
                                                @if($rule->leave_types)
                                                <input id="leave_type_id" type="hidden" class="form-control " required="" name="leave_type_id" value="{{ $rule->leave_types->id }}">
                                                @endif
                                                <input id="leave_rule_id" type="hidden" class="form-control " required="" name="leave_rule_id" value="{{ $rule->id }}">
                                                <input type="text" class="form-control " required="" name="max_no" value="{{ $rule->max_no }}" disabled>
                                                <input id="max_no" type="hidden" class="form-control " required="" name="max_no" value="{{ $rule->max_no }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group ">
                                              
                                                @if($emp->leave_allocation)
                                                <input id="leave_hand" type="type" class="form-control " required="" name="leave_hand" value="{{ $rule->max_no - $emp->leave_allocation->max_no  }}">
                                                @else
                                                <input id="leave_hand" type="type" class="form-control " required="" name="leave_hand" value="{{ $rule->max_no - $emp->max_no  }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group ">
                                                @if($rule->leave_types)
                                                <input id="effect_year" type="month" class="form-control " required="" name="effect_year" value="{{ $rule->effect_year  }}">
                                                @else
                                                <input id="effect_year" type="month" class="form-control " required="" name="effect_year" value="">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @empty
                                    @endforelse
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-10 col-sm-10 col-md-10">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="select_all" />
                                    <label class="col-form-label">
                                        Selecct All
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <button type="submit" class="btn btn-primary">Save</button>
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