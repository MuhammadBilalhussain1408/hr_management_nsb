<div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left mb-0"><br><span><img src="{{ asset('assets/images/logo.svg')}}" alt="logo-small" class="logo-sm" height="40px"> </span> </div>
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-right mb-0">
                    <li class="hidden-sm"><a class="nav-link waves-effect waves-light" href="javascript:void(0);" id="btn-fullscreen"><i class="mdi mdi-fullscreen nav-icon"></i></a></li>
                    <li class="dropdown">
                        @guest
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img alt="" src="{{asset('assets/images/user.png')}}" alt="profile-user" class="rounded-circle">
                            <span class="ml-1 nav-user-name hidden-sm"> Name <i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        @else
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            @if(Auth::user()->photo)
                            <img alt="" src="{{asset('storage/photo/'. Auth::user()->photo)}}" alt="profile-user" class="rounded-circle">
                            @else
                            <img alt="" src="{{asset('assets/images/user.png')}}" alt="profile-user" class="rounded-circle">
                            @endif
                            <span class="ml-1 nav-user-name hidden-sm"> {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        @endguest
                        <div class="dropdown-menu dropdown-menu-right">
                            @guest
                            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> {{ __('Login') }}</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> {{ __('Register') }}</a>
                            @else
                         
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted mr-2"></i> {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endguest
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled topbar-nav mb-0">
                    <li><button class="button-menu-mobile nav-link waves-effect waves-light"><i class="mdi mdi-menu nav-icon"></i></button></li>
                </ul>
            </nav><!-- end navbar-->
        </div><!-- Top Bar End -->