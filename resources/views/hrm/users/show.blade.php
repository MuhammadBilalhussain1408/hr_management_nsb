@extends('layouts.app-index')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Track Your Application</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">us
            {{$error }}
        </div>
        @endforeach

        <div class="row body_height">
            <div class="col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-4 col-xl-3">
                                <div class="card profile-box">
                                    <div class="media">
                                        <div class="media-body text-center">
                                            <h5 class="mb-0 text-white">Corporate Org</h5>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-3">
                                <div class="card profile-box">
                                    <div class="media">
                                        <div class="media-body text-center">
                                            <h5 class="mb-0 text-white">Corporate Org</h5>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-3">
                                <div class="card profile-box">
                                    <div class="media">
                                        <div class="media-body text-center">
                                            <h5 class="mb-0 text-white">Corporate Org</h5>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                        <p class="col-md-4 col-xl-4 mb-1 font-13 float-right right-padd"><span class="badge badge-default">00</span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6"> <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-8"> </div>
                                    <div class="col-sm-12 col-lg-4 float-right">
                                        <div class="input-group mb-3">
                                        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Track ypur service" aria-label="Search">
                                              <span class="input-group-append">
                                                <button class="btn btn-info" @click="searchit">
                                                    <i class="fa fa-search mdi mdi-magnify nav-icon"></i>
                                                </button>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                    </div>
                </div>
                <div class="card">
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div>
        </div>
        <!--end row-->
          <!--  <usershow></usershow>-->
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
@endsection