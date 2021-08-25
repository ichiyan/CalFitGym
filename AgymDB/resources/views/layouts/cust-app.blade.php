<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>California Fitness Gym</title>

        <!-- Favicons -->
        <link href="{{ asset('images/logo_transparent.png') }}" rel="icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


        <!-- Styles -->
        

        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/venobox/venobox.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{asset('css/welcome_style.css')}}" rel="stylesheet">
        <link href="{{asset('css/index.css')}}" rel="stylesheet">
        <link href="{{ asset('css/dashboard_style.css') }}" rel="stylesheet">

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


            @yield('hero')

            @yield('main')

    <!-- ======= Footer ======= -->

        @include('partials.footer')

    <!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <div id="preloader"></div>

    <!-- Modals -->
    @include('partials.logout-modal')
    @include('partials.change-password-modal')

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-pic-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
     window.onload = function() {
        document.getElementById('changePass').style.display = "none";
        document.getElementById('spacer').style.display = "none";
    }

    function showChangePass(){
        document.getElementById('changePass').style.display = "block";
        document.getElementById('spacer').style.display = "block";
    }
    </script>

    </body>
</html>
