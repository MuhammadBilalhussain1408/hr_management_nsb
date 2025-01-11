@extends('partial.layout')
@section('content')
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
                        <h1>{{$data->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start About Style2 Area-->
<section class="about-style2-area">
    <div class="container">


        <div class="row">
            @if($data->image)
            <div class="col-xl-12">
                <div class="about-style1__image clearfix">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="inner">
                        <img src="{{asset('upload/content/'.$data->image)}}" alt="{{$data->name}}">
                    </div>
                </div>
            </div>
            @endif
            <div class="col-xl-12">
                {!! $data->body !!}
            </div>
        </div>

    </div>
</section>

@endsection