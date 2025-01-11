<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$data->meta_title}} </title>
    <meta name="description" content="{{$data->meta_des}}">
    <meta name="keywords" content="{{$data->meta_keywords}}">
    <meta name="author" content="upintech.com | info@upintech.com">

    <meta name="og:title" content="{{$data->meta_title}}">
    <meta name="og:description" content="{{$data->meta_des}}">
    <meta name="og:keywords" content="{{$data->meta_keywords}}">
    <meta name="og:url" content="{{$data->slug}}">
    <meta name="og:image" content="{{asset('/assets/images/logo.svg')}}">
    <link rel="”canonical”" href="{{URL::full()}}">
    
    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="dWvpjTf6hIBFmp97lQFGH2lZt_Rs2BFRzeUspN1C1_M" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/custom-animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/imp.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/swiper.min.css')}}">

    <!-- Module css -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/header-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/banner-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/about-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/blog-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/fact-counter-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/faq-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/contact-page.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/breadcrumb-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/team-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/partner-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/testimonial-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/services-section.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/footer-section.css')}}">

    <link href="{{asset('frontend_assets/css/color/theme-color.css')}}" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/responsive.css')}}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend_assets/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets/images/favicon/favicon-32x32.png')}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets/images/favicon/favicon-16x16.png')}}" sizes="16x16">
    <!-- Google tag (gtag.js) -->
     <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (if you haven't already included it) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GKPLMTZG1G"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-GKPLMTZG1G');
    </script>

    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js')}}"></script>
        <script src="{{asset('frontend_assets/js/html5shiv.js')}}"></script>
    <![endif]-->

</head>

<body>
    <div class="boxed_wrapper ltr">
        <!-- preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="U" class="letters-loading">
                                U
                            </span>
                            <span data-text-preloader="K" class="letters-loading">
                                K
                            </span>
                            <span data-text-preloader="H" class="letters-loading">
                                H
                            </span>
                            <span data-text-preloader="R" class="letters-loading">
                                R
                            </span>
                            <span data-text-preloader="C" class="letters-loading">
                                C
                            </span>
                            <span data-text-preloader="L" class="letters-loading">
                                L
                            </span>
                            <span data-text-preloader="O" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="U" class="letters-loading">
                                U
                            </span>
                            <span data-text-preloader="D" class="letters-loading">
                                D
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- preloader end -->

        @include('partial.header')
        @yield('content')
        @include('partial.footer')

        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="flaticon-up-arrow"></span>
        </button>

        <!-- search-popup -->
        <div id="search-popup" class="search-popup">
            <div class="close-search"><i class="icon-close"></i></div>
            <div class="popup-inner">
                <div class="overlay-layer"></div>
                <div class="search-form">
                    <form method="post" action="#">
                        <div class="form-group">
                            <fieldset>
                                <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required>
                                <input type="submit" value="Search Now!" class="theme-btn style-four">
                            </fieldset>
                        </div>
                    </form>
                    <h3>Recent Search Keywords</h3>
                    <ul class="recent-searches">
                        <li><a href="index.html">waste</a></li>
                        <li><a href="index.html">Dumpster</a></li>
                        <li><a href="index.html">Zerowaste</a></li>
                        <li><a href="index.html">Garbage</a></li>
                        <li><a href="index.html">trash</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- search-popup end -->
    </div>

    <script src="{{asset('frontend_assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend_assets/js/aos.js')}}"></script>
    <script src="{{asset('frontend_assets/js/appear.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/isotope.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.countTo.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.event.move.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.paroller.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery-sidebar-content.js')}}"></script>
    <script src="{{asset('frontend_assets/js/knob.js')}}"></script>
    <script src="{{asset('frontend_assets/js/map-script.js')}}"></script>
    <script src="{{asset('frontend_assets/js/owl.js')}}"></script>
    <script src="{{asset('frontend_assets/js/pagenav.js')}}"></script>
    <script src="{{asset('frontend_assets/js/scrollbar.js')}}"></script>
    <script src="{{asset('frontend_assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/tilt.jquery.js')}}"></script>
    <script src="{{asset('frontend_assets/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/validation.js')}}"></script>
    <script src="{{asset('frontend_assets/js/wow.js')}}"></script>

    <script src="{{asset('frontend_assets/js/jquery-1color-switcher.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/parallax.min.js')}}"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM&amp;callback=initMap">
    </script>

    <!-- thm custom script -->
    <script src="{{asset('frontend_assets/js/custom.js')}}"></script>



</body>

</html>