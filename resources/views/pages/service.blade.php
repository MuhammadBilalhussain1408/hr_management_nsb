@extends('partial.layout')
@section('content')
@php
$isActive = true;
$hasError = false;
@endphp
<!--Start breadcrumb area paroller-->
<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url(assets/images/breadcrumb/breadcrumb-1.jpg);">
    </div>
    <div class="shape-box"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">

                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li class="active">{{$data->name}}</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>{{$data->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

        <!--Start Service Details area -->
        <section class="service-details-area">
            <div class="container">
                <div class="row">

                    <!--Start Service Details Sidebar -->
                    <div class="col-xl-4 col-lg-5 order-box-2">
                        <div class="service-details__sidebar">

                            <div class="view-all-service">
                                <ul class="service-pages">
                                    @forelse($submenus as $sub)
                                    @php if( $data->slug == $sub->slug) {$active = 'active';} else {$active = '';}  @endphp 
                                   
                                    <li class="{{$active}}">
                                        <a href="{{URL::to('/service/'.$sub->slug)}}">
                                            {{$sub->name}} <span class="icon-right-arrow"></span>
                                        </a>
                                    </li>
                                    @empty
                                    @endforelse
                                   
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!--End Service Details Sidebar -->

                    <!--Start Service Details Content -->
                    <div class="col-xl-8 col-lg-7 order-box-1">
                        <div class="service-details__content">
                            @if($data->image)
                            <div class="img-box-outer">
                                <div class="img-box1">
                                    <img src="{{asset('upload/submenu/'.$data->image)}}" alt="{{$data->name}}" />
                                </div>
                                <div class="icon">
                                    <span class="icon-creative"></span>
                                </div>
                            </div>
                            @endif

                            <div class="text-box1">
                                <h2>{{$data->name}}</h2>
                                <p>
                                    {!! $data->body !!}
                                </p>
                            </div>

                            <!-- <div class="text-box2">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="text-box2-single" data-aos="fade-right" data-aos-easing="linear"
                                            data-aos-duration="1500">
                                            <p>Refresing to get such a touch. Duis aute irure dolor in oluptate.</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="text-box2-single" data-aos="fade-left" data-aos-easing="linear"
                                            data-aos-duration="1500">
                                            <p>Velit esse cillum eu fugiat pariatur. Duis aute irure dolor in in
                                                voluptate.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="text-box3">
                                <p>When an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book. It has survived not only five centuries, but also the leap into
                                    electronic typesetting. Lorem Ipsum has been the ndustry standard dummy text ever
                                    since the 1500s.
                                </p>
                            </div> -->
                            <!-- <div class="text-box4">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="img-box">
                                            <img src="{{asset('upload/service/')}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="content-box">
                                            <h2>thtgh </h2>
                                            <p>
                                                gfhgj
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="service-details-faq-content">
                                <ul class="accordion-box">
                                @forelse($content as $key => $con)
                                    @php 
                                    if( $key == 0) {$activeblock = 'active-block'; $active = 'active'; $current = 'current';} else {$activeblock = ''; $active = ''; $current = '';}
                                    @endphp 
                                    <li class="accordion block {{$activeblock}}">
                                        <div class="acc-btn {{$active}}">
                                            <div class="icon-outer">
                                                <i class="icon-down-arrow"></i>
                                            </div>
                                            <h3>{{$con->name}} {{ $key}} </h3>
                                        </div>
                                        <div class="acc-content {{$current}}">
                                            <p> {!! $con->body !!} </p>
                                        </div>
                                    </li>
                                    @empty
                                @endforelse
                                    <!-- <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-outer">
                                                <i class="icon-down-arrow"></i>
                                            </div>
                                            <h3>Maecenas condimentum sollicitudin ligula.</h3>
                                        </div>
                                        <div class="acc-content">
                                            <p>Suspendisse finibus urna mauris, vitae consequat quam vel. Vestibulum leo
                                                ligula, vit commodo nisl Sed luctus venenatis pellentesque.</p>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!--End Service Details Content -->

                </div>
            </div>
        </section>
        <!--End Service Details area -->


@endsection