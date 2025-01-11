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
                                    <li><a href="index.html">Home</a></li>
                                    <li class="active">Error</li>
                                </ul>
                            </div>
                            <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                                <h2>404 Error</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->


        <!--Start Error Page Area-->
        <section class="error-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="error-content text-center">
                            <div class="big-title wow fadeInDown" data-wow-delay="100ms" data-wow-duration="1500ms">
                                <h2>Oh...ho...</h2>
                            </div>
                            <div class="title wow fadeInDown" data-wow-delay="100ms" data-wow-duration="1500ms">
                                <h2>Sorry, Something Went Wrong.</h2>
                            </div>
                            <div class="text">
                                <p>The page you are looking for was moved, removed, renamed<br> or never existed.</p>
                            </div>

                            <div class="error-page-search-box">
                                <form class="search-form" action="#">
                                    <input placeholder="Search ..." type="text">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <div class="btns-box wow slideInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <a class="btn-one" href="index.html">
                                    <span class="txt">Back to Home<i class="icon-refresh arrow"></i></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Error Page Area-->

@endsection