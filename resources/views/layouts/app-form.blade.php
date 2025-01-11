<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UK HR CLOUD</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta content="UpInTech" name="description">
        <meta content="Afroza Prova" name="author">
    <link rel="icon" type="image/x-icon" href="admin-assets/img/favicon.ico"/>
    <link href="{{asset('admin-assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('admin-assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('admin-assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL admin-assets/plugins/CUSTOM STYLES -->
    <link href="{{asset('admin-assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>
<body>
<div id="app">
    @include('layouts.top-bar')
    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
          
        </header>
    </div>
    <!--  END NAVBAR  -->
    <div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>
    @include('layouts.sidebar')
    @yield('content')
    </div>
</div>
       <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('admin-assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('admin-assets/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin-assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
     <script src="{{asset('admin-assets/plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('admin-assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL plugins CUSTOM SCRIPTS -->
    <script src="{{asset('admin-assets/js/scrollspyNav.js')}}"></script>
    <!-- BEGIN PAGE LEVEL plugins CUSTOM SCRIPTS -->
</body>
</html>
