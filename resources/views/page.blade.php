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
@if($data->slug == 'about')
<!--Start About Style2 Area-->
<section class="about-style2-area">
    <div class="container">

        <div class="row">
            @if($data->image)
            <div class="col-xl-6">
                <div class="about-style1__image clearfix">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="inner">
                        <img src="{{asset('upload/menu/'.$data->image)}}" alt="{{$data->name}}">
                    </div>
                </div>
            </div>
            @endif

            <div class="col-xl-6">
                <div class="about-style2__content about-style2__content--in-about-style3">
                    <div class="sec-title sec-title--style2">
                        <div class="sub-title">
                            <div class="border-box"></div>
                            <h3>{{$data->name}}</h3>
                        </div>
                        <h2>{{$data->meta_title}}</h2>
                    </div>
                    <div class="inner-content">
                        <div class="top-text">
                            <div class="icon">
                                <span class="icon-recruit"></span>
                            </div>
                            <div class="inner-title">
                                <h3>
                                    <span> {!! $data->body !!} <span>
                                </h3>
                            </div>
                        </div>
                        @if($content)
                        <ul>
                            @forelse($content as $con)
                            <li>
                                <span class="icon-check"></span>
                                {!! $con->body !!}
                            </li>
                            @empty
                            @endforelse

                        </ul>
                        @endif

                        <!-- <div class="signature-box">
                            <h2>Kevin Martin <span>- CO Founder</span></h2>
                        </div> -->

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--End About Style2 Area-->
@if($data->slug == 'contact')
<!--Start Main Contact Form Area-->
<section class="main-contact-form-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>Contact with us</h3>
            </div>
            <h2>Write a Message</h2>
             @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="contact-form">
                    <form class="default-form2" action="{{URL::to('/conatct_post')}}" method="post">
                         @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="text" name="name" id="formName" placeholder="Full Name" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="email" name="email" id="formEmail" placeholder="Email Address" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="text" name="phone" value="" id="formPhone" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="text" name="subject" value="" id="formSubject" placeholder="Subject">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <div class="input-box">
                                        <textarea name="message" id="formMessage" placeholder="Write a Message" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 text-center">
                                <div class="button-box">
                                    <input id="form_botcheck" name="botcheck" class="form-control" type="hidden" value="">
                                    <button class="btn-one" type="submit" data-loading-text="Please wait...">
                                        <span class="txt">
                                            send a message
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<!--End Main Contact Form Area-->
@else
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
                        <img src="{{asset('upload/menu/'.$data->image)}}" alt="{{$data->name}}">
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
<section class="blog-style1-area">
    <div class="blog-style1-area__bg"></div>
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>What’s Happening</h3>
            </div>
            <h2>News & Articles</h2>
        </div>
        <div class="row">
            <!--Start Single Blog Style1-->

            @forelse($content as $con)
            <div class="col-xl-4 col-lg-12">
                <div class="single-blog-style1">
                    <div class="img-holder">
                        <img src="{{asset('upload/content/'.$con->image)}}" alt="{{$con->name}}">
                        <div class="date-box">
                            <p>{{$con->created_at->format('d ,Y')}} </p>
                        </div>
                    </div>
                    <div class="text-holder">
                        <!-- <div class="meta-info">
                                    <ul>
                                        <li><span class="icon-user"></span><a href="#">by Admin</a></li>
                                        <li><span class="icon-conversation"></span><a href="#">2 Comments</a></li>
                                    </ul>
                                </div> -->
                        <h3><a href="{{URL::to('view/'.$con->slug)}}">{{$con->name}}</a></h3>
                        <div class="btn-box">
                            <a href="{{URL::to('view/'.$con->slug)}}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse

        </div>
    </div>
</section>
@endif


@endsection