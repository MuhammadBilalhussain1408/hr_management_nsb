<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UK HR Cloud -Human resource management system </title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/font-awesome.min.css')}}">

    <!-- Module css -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/module-css/contact-page.css')}}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend_assets/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets/images/favicon/favicon-32x32.png')}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets/images/favicon/favicon-16x16.png')}}" sizes="16x16">
  <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GKPLMTZG1G"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-GKPLMTZG1G');
    </script>

</head>

<body>
    <div class="boxed_wrapper ltr">
      

        @yield('content')

        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="flaticon-up-arrow"></span>
        </button>

    </div>

    <script src="{{asset('frontend_assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>
  

</body>

</html>