<div class="bottom-parallax">
            <!--Start footer area -->
            <footer class="footer-area">
                <!--Start Footer-->
                <div class="footer">
                    <div class="container">
                        <div class="row text-right-rtl">

                            <!--Start single footer widget-->
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-footer-widget single-footer-widget--company-info marbtm50">
                                    <div class="our-company-info">
                                        <div class="text-box">
                                            <p>49 Wilmslow Road, M14 5TB, Manchester</p>
                                        </div>
                                        <h2><a href="tel:01615297766">01615297766</a></h2>
                                        <h3><a href="mailto:info@ukhrcloud.com">info@ukhrcloud.com</a></h3>
                                        <div class="footer-social-link">
                                            <ul class="clearfix">
                                                <li>
                                                    <a href="#"><i class="icon-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icon-facebook-circular-logo"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icon-pinterest"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icon-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single footer widget-->

                            <!--Start single footer widget-->
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="single-footer-widget single-footer-widget--link-box marbtm50">
                                    <div class="title">
                                        <h3>Explore</h3>
                                    </div>
                                    <div class="footer-widget-links">
                                        <ul>
                                            <li><a href="{{route('about')}}">About</a></li>
                                            <li><a href="{{route('contact')}}">Contact</a></li>
                                        </ul>
                                        <ul class="right">
                                            <li><a href="{{URL::to('/terms')}}">Terms of Use</a></li>
                                            <li><a href="{{URL::to('/privacy-policy')}}">Privacy Policy</a></li>
                                            <li><a href="{{URL::to('/contact')}}">Help</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--End single footer widget-->

                            <!--Start single footer widget-->
                            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                <div class="single-footer-widget">
                                    <div class="title">
                                        <h3>Newsletter</h3>
                                    </div>
                                    <form class="newsletter-form"  action="{{URL::to('/conatct_post')}}" method="post">
                                         @csrf
                                        <input type="email" name="email" placeholder="Email Address">
                                        <button class="btn-one" type="submit">
                                            <span class="txt">Subscribe</span>
                                        </button>
                                        <div class="checked-box1">
                                            <input type="checkbox" name="newsletter-check" id="newsletter" checked="">
                                            <label for="newsletter">
                                                <span></span>I agree to all terms and policies
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--End single footer widget-->

                        </div>
                    </div>
                </div>
                <!--End Footer-->
                <div class="footer-bottom">
                    <div class="container">
                        <div class="bottom-inner">
                            <div class="footer-logo-style1">
                                <a href="{{URL::to('/')}}">
                                    <img src="{{ asset('assets/images/logo.svg')}}" alt="Awesome Logo" title="" style=" height:55px"> UK HR Cloud
                                </a>
                            </div>
                            <div class="copyright">
                                <p>Copyright &copy; {{date('Y')}} <a href="{{URL::to('/')}}">UK HR Cloud</a> All Rights Reserved. Power by<a href="upintech.com"> UpInTech</a></p>
                            </div>

                        </div>
                    </div>
                </div>

            </footer>
            <!--End footer area-->
        </div>