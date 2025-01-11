@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-flu">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/hrm/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee profile </li>
                        </ol>
                    </div>
                </div>
            </div>
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
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div><!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-md-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2 class="page-title"> {{Auth::user()->org->company_name}} </h2>
                                    <h4 class="page-title"> {{Auth::user()->org->address}} </h4>
                                    <h3 class="page-title"> Leave Register Of {{$year}} </h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='150' class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>Serial NO</th>
                                                <th>Employee ID</th>
                                                <th> Name</th>
                                                <th>Designation</th>
                                                <th class="text-center">Leave Type
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                @forelse($leave_types as $key=> $ltype)
                                                                <th class="w10"><small>{{$ltype->name}} </small></th>
                                                                @empty
                                                                @endforelse
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($employees as $key=> $emp)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$emp->code}}</td>
                                                <td> {{$emp->fname}} {{$emp->mid_name}} {{$emp->lname}}</td>
                                                <td> {{$emp->department->name}}</td>
                                                <td>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                @forelse($leave_types as $key=> $ltype)
                                                                <td class="w10"><small>{{$l_allocation->where('leave_type_id',$ltype->id)->where('employee_id',$emp->id)->pluck('leave_hand')->first()}} </small></td>
                                                                @empty
                                                                @endforelse
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->

    @endsection