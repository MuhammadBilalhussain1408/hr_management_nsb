        <!--Start Blog Style1 Area-->
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
                  
                    @forelse($blogs as $con)
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
                    <!--End Single Blog Style1-->

                    <!--Start Single Blog Style1-->
                    <!-- <div class="col-xl-4 col-lg-12">
                        <div class="single-blog-style1">
                            <div class="img-holder">
                                <img src="frontend_assets/images/blog/blog-v1-2.jpg" alt="">
                                <div class="date-box">
                                    <p>20 oct</p>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="meta-info">
                                    <ul>
                                        <li><span class="icon-user"></span><a href="#">by Admin</a></li>
                                        <li><span class="icon-conversation"></span><a href="#">2 Comments</a></li>
                                    </ul>
                                </div>
                                <h3><a href="#">How to Manage Your Business’s Online Reputation</a></h3>
                                <div class="btn-box">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-xl-4 col-lg-12">
                        <div class="single-blog-style1">
                            <div class="img-holder">
                                <img src="frontend_assets/images/blog/blog-v1-3.jpg" alt="">
                                <div class="date-box">
                                    <p>20 oct</p>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="meta-info">
                                    <ul>
                                        <li><span class="icon-user"></span><a href="#">by Admin</a></li>
                                        <li><span class="icon-conversation"></span><a href="#">2 Comments</a></li>
                                    </ul>
                                </div>
                                <h3><a href="#">If You Want to be a Great Leader Shut Up and Just
                                        Listen</a></h3>
                                <div class="btn-box">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                   


                </div>
            </div>
        </section>
        <!--End Blog Style1 Area-->