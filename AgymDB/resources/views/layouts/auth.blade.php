<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Styles -->
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/venobox/venobox.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{asset('css/welcome_style.css')}}" rel="stylesheet">
<link href="{{asset('css/login_style.css')}}" rel="stylesheet">

 <!-- CoreUI CSS -->

 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
<link rel ="stylesheet" href = "/app.css">

 <title>{{config('app.name','CalFitGym')}}</title>
 <!-- Favicons -->
 <link href="{{ asset('images/logo_transparent.png') }}" rel="icon">

 </head>
 <body>
    <!-- ======= Top Bar ======= -->
    @include('partials.topbar-contact-details')

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{ url('/') }}">California Fitness Gym</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        @yield('topnav')

        </div>
    </header><!-- End Header -->

    <div id="login-bg">
        @yield('content')
    </div>

    @include('partials.footer')


      <!-- Vendor JS Files -->
  <script src=" {{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src=" {{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src=" {{ asset('vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src=" {{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src=" {{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src=" {{ asset('vendor/venobox/venobox.min.js')}}"></script>
  <script src=" {{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src=" {{ asset('vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src=" {{ asset('js/main.js') }} "></script>

 </body>
</html>
