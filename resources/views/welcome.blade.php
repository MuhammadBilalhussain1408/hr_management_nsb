@extends('partial.layout')
@section('content')
@include('partial.slider')
<!--Start About Style2 Area-->
<section class="about-style2-area">
    <div class="container">
        <div class="row">
            @php 
             $about = $datas->where('id',2)->first();
             if($about){
                $contents = $about->contents()->take('4')->get();
             }
             else{
              $contents = '';
             }
            
             $service = $datas->where('id',3)->first();
              if($service){
                $ser_contents = $service->contents()->take('4')->get();
              }
              else{
               $ser_contents = '';
              }
           
            @endphp

            <div class="col-xl-6">
                <div class="about-style2__content">
                    <div class="sec-title sec-title--style2">
                        <div class="sub-title">
                            <div class="border-box"></div>
                            <h3>About the company</h3>
                        </div>
                        <h2>{{$about->meta_title}}</h2>
                    </div>
                    <div class="inner-content">
                        <div class="top-text">
                            <div class="icon">
                                <span class="icon-recruit"></span>
                            </div>
                            <div class="inner-title">
                                <h3>{!! $about->body !!}</h3>
                            </div>
                        </div>

                        <!-- <div class="text-box">
                            <p>There are many variations of passages of lorem free market to available, but the
                                majority have alteration in some form, by injected humour, or randomised words.
                            </p>
                        </div> -->

                        <div class="row">
                        @forelse($contents as $con)
                            <div class="col-xl-6">
                                <ul>
                                    <li>
                                        <span class="icon-check"></span>
                                       {{$con->name}}
                                    </li>
                                </ul>
                            </div>
                            @empty
                        @endforelse
                          
                        </div>

                        <div class="btn-box">
                            <a class="btn-one" href="{{URL::to('/about')}}">
                                <span class="txt">Discover More</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="about-style2__image clearfix">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="border-box float-bob-y"></div>
                    <div class="inner">
                        <img src="{{asset('upload/menu/'.$about->image)}}" alt="{{$about->name}}">
                        <div class="overlay-content">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="4800">0</span>
                            </div>
                            <h3>Projects Completed</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End About Style2 Area-->


<!--Start Service Style2 Area-->
<section class="service-style2-area">
    <div class="service-style2--primary-bg"></div>
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>Our Services</h3>
            </div>
            <h2>What We’re Offering</h2>
        </div>
        <div class="row text-right-rtl">
            <!--Start Single Service Style2-->
            @if($service)
            @forelse($service->submenus as $sub)
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="single-service-style2">
                    @if($sub->image)
                    <div class="img-holder">
                        <div class="inner">
                        <img src="{{asset('upload/submenu/'.$sub->image)}}" alt="{{$sub->name}}">
                        </div>
                        <div class="icon">
                            <span class="icon-creative"></span>
                        </div>
                    </div>
                    @endif
                    <div class="title-holder">
                        <h3><a href="{{URL::to('/service/'.$sub->slug)}}">{{$sub->name}}</a></h3>
                        <div class="text">
                            <p>
                            {!! Illuminate\Support\Str::limit($sub->body, 100) !!}
                            </p>
                        </div>
                        <div class="btn-box">
                            <a href="{{URL::to('/service/'.$sub->slug)}}"><span class="icon-right-arrow"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            @endif
          
        </div>
    </div>
</section>
<!--End Service Style2 Area-->

<!--Start Choose Area-->
<section class="choose-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="choose-img-box">
                    <div class="border-box float-bob-y"></div>
                    <div class="inner">
                        <img src="frontend_assets/images/resources/choose-img-1.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="choose-content-box">
                    <div class="sec-title sec-title--style2">
                        <div class="sub-title">
                            <div class="border-box"></div>
                            <h3>get benefits</h3>
                        </div>
                        <h2>Why Choose Our<br> Consultancy</h2>
                    </div>
                    <div class="inner-content">
                        <div class="top-text">
                            <p>HRMS stands for "Human Resource Management System." It is a software solution designed to help organizations manage and streamline various human resource functions and processes efficiently. HRMS software provides a centralized platform that automates and integrates essential HR tasks, making it easier for HR professionals to handle employee-related activities.</p>
                        </div>
                        <!-- <ul>
                            <li>
                                <div class="inner">
                                    <div class="icon">
                                        <span class="icon-right-arrow"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Donec Quis felis Commodo</h3>
                                        <p>Lorem ipsum is simply free text dolor sit amet, consectetur notted.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="inner">
                                    <div class="icon">
                                        <span class="icon-right-arrow"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Donec Quis felis Commodo</h3>
                                        <p>Lorem ipsum is simply free text dolor sit amet, consectetur notted.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Choose Area-->

<!--Start Features Style1 Area-->
<section class="features-style1-area">
    <div class="features-style1-img-box">
        <div class="features-style1-img-bg" style="background-image: url(frontend_assets/images/resources/features-style1-img-bg.jpg);">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="features-style1__content">
                    <div class="sec-title sec-title--style2">
                        <div class="sub-title">
                            <div class="border-box"></div>
                            <h3>What’s Happening</h3>
                        </div>
                        <h2>Looking for Top<br> Consultants</h2>
                    </div>
                    <div class="inner-content">
                        <!-- <ul>
                            <li>
                                <span class="icon-right-arrow"></span>
                                Nsectetur cing elit.
                            </li>
                            <li>
                                <span class="icon-right-arrow"></span>
                                Suspe ndisse suscipit sagittis leo.
                            </li>
                            <li>
                                <span class="icon-right-arrow"></span>
                                Entum estibulum dignissim posuere.
                            </li>
                        </ul> -->
                        <div class="btn-box">
                            <a class="btn-one" href="{{URL::to('/about')}}">
                                <span class="txt">Discover More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="features-style1__items">
                    <ul>
                        <li>
                            <div class="top">
                                <div class="icon">
                                    <span class="icon-help"></span>
                                </div>
                                <div class="title">
                                    <h3>We’re Serving<br> 30 Years</h3>
                                </div>
                            </div>
                            <!-- <div class="inner-text">
                                <p>Lorem ipsum dolor sit a consetetur simple is pscing elitr m nonmy simply free
                                    text.</p>
                            </div> -->
                        </li>
                        <li>
                            <div class="top">
                                <div class="icon">
                                    <span class="icon-customer-review"></span>
                                </div>
                                <div class="title">
                                    <h3>The Largest<br> UK HR Cloud Firm</h3>
                                </div>
                            </div>
                            <!-- <div class="inner-text">
                                <p>Lorem ipsum dolor sit a consetetur simple is pscing elitr m nonmy simply free
                                    text.</p>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Features Style1 Area-->

<!--Start Google Map Style1 Area-->
<section class="google-map-style1-area">
    <div class="auto-container">
        <div class="home1-page-map-outer">
            <!--Map Canvas-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d100859.05968544542!2d144.955631!3d-37.817085!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1690038112282!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- <div class="map-canvas" data-zoom="12" data-lat="53.456620" data-lng="-2.225780" data-type="roadmap" data-hue="#ffc400" data-title="UK HR Cloud" data-icon-path="frontend_assets/images/icon/map-marker.png" data-content="1st Floor, 49-51 Wilmslow Rd, Manchester M14 5TB, United Kingdom<br><a href='mailto:info@ukhecloud.com'>info@ukhrcloud.com</a>">
            </div> -->
        </div>
    </div>
</section>
<!--End Google Map Style1 Area-->


<!--Start Features Style2 Area-->
<section class="features-style2-area">
    <div class="features-style2-area__bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="features-style2__content">
                    <div class="features-style2__content-bg" style="background-image: url(frontend_assets/images/resources/features-style2__content-bg.jpg);">
                    </div>
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="top-title">
                        <h2>We Shape the Perfect<br> Solution for Your Business</h2>
                    </div>
                    <div class="features-style2__content-inner">
                        <div class="row">

                            <!--Start Features Style2 Single Box-->
                            <div class="col-xl-4 col-lg-4">
                                <div class="features-style2-single-box">
                                    <span class="icon-conversation-1"></span>
                                    <div class="inner-title">
                                        <h3>Trusted Agency</h3>
                                        <!-- <p>Morbi nec finibus misd</p> -->
                                    </div>
                                </div>
                            </div>
                            <!--End Features Style2 Single Box-->
                            <!--Start Features Style2 Single Box-->
                            <div class="col-xl-4 col-lg-4">
                                <div class="features-style2-single-box">
                                    <span class="icon-checking"></span>
                                    <div class="inner-title">
                                        <h3>Quality Services</h3>
                                        <!-- <p>Morbi nec finibus misd</p> -->
                                    </div>
                                </div>
                            </div>
                            <!--End Features Style2 Single Box-->
                            <!--Start Features Style2 Single Box-->
                            <div class="col-xl-4 col-lg-4">
                                <div class="features-style2-single-box">
                                    <span class="icon-cyber-security"></span>
                                    <div class="inner-title">
                                        <h3>Best Strategy</h3>
                                        <!-- <p>Morbi nec finibus misd</p> -->
                                    </div>
                                </div>
                            </div>
                            <!--End Features Style2 Single Box-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Features Style2 Area-->

@include('partial.blog')
@include('partial.partner')


@endsection