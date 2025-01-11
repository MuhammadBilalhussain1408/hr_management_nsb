@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    @if(!(Auth::user()->roles))
                     <div class="alert alert-danger"> 
                        Please Contact admin for verify your account
                    </div>
                    @endif                  
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Home</a></li>
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
                    <div class="col-md-12 col-xl-12">
                        <div class="row">
                        <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Organization</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">

                                                   @if($organizations) <h5>{{$organizations->count()}}</h5>@endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.organizations.index') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Active Employees</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($employees) <h5>{{$employees->count()}}</h5> @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.employees.index') }}" class="text-success">

                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Migrant Employees</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($employes_mig) <h5>{{$employes_mig->count()}}</h5> @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.emp_migrant') }}" class="text-success">

                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of right_works</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($rightwords) <h5>{{$rightwords->count()}}</h5> @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.right_works.index') }}" class="text-success">

                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Job post</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($job_posts) <h5>{{$job_posts->count()}}</h5> @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.job_posts.index') }}" class="text-success">

                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Application Received</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($app_receceived) <h5>{{$app_receceived->count()}}</h5> @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.job_applieds.index') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Short list</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($short_list) <h5>{{$short_list->count()}}</h5> @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.job_shortlist') }}" class="text-success">

                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Interview</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($interviews) <h5>{{$interviews->count()}}</h5> @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.interview') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Hired</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($hired) <h5>{{$hired->count()}}</h5> @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.hired') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Job offer</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($job_offers) <h5>{{$job_offers->count()}}</h5> @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.offer_letter') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="col-md-2">
                                                    <i class="mdi mdi-account-location" style='font-size:36px'></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>Number of Reject</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="col-md-8">
                                                     @if($rejects) <h5>{{$rejects->count()}}</h5> @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('hrm.rejectted') }}" class="text-success">
                                                    <i class="	far fa-arrow-alt-circle-right" style='font-size:36px'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
        <!--end row-->
        <!--  <usershow></usershow>-->
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
@endsection