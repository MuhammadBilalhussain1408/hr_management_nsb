@php
$isActive = true;
$hasError = false;
@endphp
<!-- Main header-->
<header class="main-header header-style-two">

    <div class="header-style2__top">
        <div class="container">
            <div class="outer-box">
                <div class="header-style2__top-left">
                    <div class="header-contact-info">
                        <ul>
                            <li>
                                <div class="icon">
                                    <span class="icon-email"></span>
                                </div>
                                <div class="text">
                                    <h6><a href="mailto:info@ukhrcloud.com">info@ukhrcloud.com</a></h6>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-placeholder"></span>
                                </div>
                                <div class="text">
                                    <h6>49 Wilmslow Road, M14 5TB, Manchester</h6>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-user"></span>
                                </div>
                                <div class="text">
                                <a href="{{route('admin.login')}}"><span>Login</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="header-style2__top-right">
              
                    <div class="header-social-link">
                        <ul class="clearfix">
                            <li>
                                <a href="#">
                                    <span class="icon-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon-facebook-circular-logo"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon-pinterest"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon-instagram"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--Start Header-->
    <div class="header-style2">
        <div class="container">
            <div class="outer-box">
                <!--Start Header Left-->
                <div class="header-style2__left">
                    <div class="logo-box-style2">
                        <a href="{{URL::to('/')}}">
                            <img src="{{ asset('assets/images/logo.svg')}}" alt="Awesome Logo" title="" style=" height:55px">
                        </a>
                    </div>

                    <div class="nav-outer style2 clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <div class="inner">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu style2 navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    @forelse($datas as $menu)
                                    @if($menu->submenus->count() >0)
                                    <li class="dropdown"><a href="{{URL::to($menu->slug)}}"><span>{{$menu->name}}</span></a>
                                        <ul>
                                            @forelse($menu->submenus as $sub)
                                            <li><a href="{{URL::to('service/'.$sub->slug)}}">{{$sub->name}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </li>
                                    @else
                                    <li><a href="{{URL::to($menu->slug)}}"><span>{{$menu->name}}</span></a>
                                    </li>
                                    @endif

                                    @empty
                                    @endforelse
                                    <!-- <li @class(['dropdown','current'=> $isActive,'dropdown' => !$isActive,])><a href="/"><span>Home</span></a> </li>
                                    <li><a href="{{route('about')}}"><span>About</span></a></li>

                                    <li class="dropdown"><a href="#"><span>Services</span></a>
                                        <ul>
                                            <li><a href="services.html">View All Services</a></li>
                                            <li><a href="#">Consumer Product</a></li>
                                            <li><a href="#">Banking Advising</a></li>
                                            <li><a href="#">Marketing Rules</a></li>
                                            <li><a href="#">Business Growth</a></li>
                                            <li><a href="#">Audit Marketing</a></li>
                                            <li><a href="#">Financial Advice</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown"><a href="#"><span>Blog</span></a>
                                        <ul>
                                            <li><a href="#">Blog </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('contact')}}"><span>Contact</span></a></li> -->
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>

                    <div class="serach-button-style1 serach-button-style1--instyle2">
                        <button type="button" class="search-toggler">
                            <i class="icon-magnifying-glass"></i>
                        </button>
                    </div>

                </div>
                <!--End Header Left-->

                <!--Start Header Right-->
                <div class="header-style2__right">
                    <div class="phone-number-box1 phone-number-box1--style2">
                        <div class="icon">
                            <span class="icon-phone-call"></span>
                        </div>
                        <div class="phone">
                            <p>Call Anytime</p>
                            <a href="tel:01615297766">01615297766</a>
                        </div>
                    </div>
                </div>
                <!--End Header Right-->

            </div>
        </div>
    </div>
    <!--End header-->

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container">
            <div class="clearfix">
                <!--Logo-->
                <div class="logo float-left">
                    <a href="{{URL::to('/')}}" class="img-responsive">
                        <img src="{{ asset('assets/images/logo.svg')}}" alt="Awesome Logo" title="" style=" height:55px">
                    </a>
                </div>
                <!--Right Col-->
                <div class="right-col float-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--End Sticky Header-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon fa fa-times-circle"></span></div>
        <nav class="menu-box">
            <div class="nav-logo"><a href=""><img src="{{ asset('assets/images/logo.svg')}}" alt="Awesome Logo" title="" style=" height:55px"> </a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <!--Social Links-->
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa fa-twitter-square"></span></a></li>
                    <li><a href="#"><span class="fab fa fa-pinterest-square"></span></a></li>
                    <li><a href="#"><span class="fab fa fa-google-plus-square"></span></a></li>
                    <li><a href="#"><span class="fab fa fa-youtube-square"></span></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>