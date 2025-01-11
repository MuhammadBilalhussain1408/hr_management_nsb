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
                            <li class="breadcrumb-item active"> Leave Report l_all->employee Wise </li>
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
                                <div class="table-responsive">
                                    <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='150' class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>Serial NO</th>
                                                <th>employee ID</th>
                                                <th> Name</th>
                                                <th>Leave type</th>
                                                <th>Date of app</th>
                                                <th>Duration</th>
                                                <th>Number of days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($l_allocation as $key=> $l_all)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$l_all->emp->code}}</td>
                                                <td> {{$l_all->emp->fname}} {{$l_all->emp->mid_name}} {{$l_all->emp->lname}}</td>
                                                <td> {{$l_all->leave_types->name}}</td>
                                                <td>{{$l_all->created_at->format('Y-m-d')}}</td>
                                                <td>{{$l_all->effect_year}}</td>
                                                <td>{{$l_all->leave_hand}}</td>
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