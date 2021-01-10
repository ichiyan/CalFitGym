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



    </head>
    <body>

        <!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top ">
    <div class="container d-flex">
    <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:cebuultimategym@gmail.com">cebuultimategym@gmail.com</a>
        <i class="icofont-smart-phone"></i> 0905 523 1075
        <i class="icofont-clock-time"></i> Mon - Sat 6:30 am - 11:00 pm Sun 2:00 pm - 11:00pm
    </div>
    <div class="social-links">
        <a href="https://twitter.com/CFgymCebu" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="https://www.facebook.com/Californiafitnessgym" target="_blank" class="facebook"><i class="icofont-facebook"></i></a>
    </div>
    </div>
</div>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top ">
            <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto"><a href="{{ url('/welcome') }}">California Fitness Gym</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/#about">About</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="">Facility</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Rates</a></li>
                    <li><a href="/#contact">Contact</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/home') }}">My Account</a></li>
                        @else
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        @endauth

                    @endif

                </ul>
            </nav><!-- .nav-menu -->

            </div>
        </header><!-- End Header -->



        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
            <h1>Welcome to CalFit Gym</h1>
            <h2>where we help you obtain a healthy and fit lifestyle</h2>
            <a href="#about" class="btn-get-started scrollto">Learn More</a>
            </div>
        </section><!-- End Hero -->

        <main id="main">
        <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                         <img src="{{ asset('images/about.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <h3>What we do</h3>
                    <p>
                        A stong and healthy body is essential to be able to enjoy life to the fullest
                        and we at California Fitness Gym, are here to journey with you in the mission
                        to attain a strong and fit body through excellent euqipment, service, and amenities.
                        Our team is always keen to help you achieve your fitness goals. Join us now!
                    </p>
                    </div>
                </div>

                </div>
            </section><!-- End About Section -->

             <!-- ======= Services Section ======= -->
            <section id="services" class="services">
                <div class="container">

                <div class="section-title">
                    <span>Services</span>
                    <h2>Services</h2>
                    <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
                </div>

                </div>


                <div class="grid">
                    <div>
                        <div class="container">
                            <div class="row quality-equipment">
                                <div class="col-lg-4 text-block" data-aos="fade-right">
                                    <div class="text-lockup">
                                        <h3>We provide you</h3>
                                        <h2>Quality Equipment</h2>
                                        <i class="icofont-gym-alt-2 icofont-2x"></i>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                        <a href="">View Gallery</a>
                                    </div>
                                </div>
                                <div class="col-lg-8 large-thumb" data-aos="fade-left"></div>

                            </div>

                            <div class="row personalized-coaching">
                                <div class="col-lg-8 large-thumb" data-aos="fade-right"></div>
                                <div class="col-lg-4 text-block" data-aos="fade-left">
                                    <div class="text-lockup">
                                        <h3>Improve through</h3>
                                        <h2>Personalized Coaching</h2>
                                        <i class="icofont-gym icofont-2x"></i>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                        <a href="">View Rates</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row mid-unit">
                            <div class="col-lg-4 healthy-options">
                                <div class="small-thumb" data-aos="fade-right"></div>
                                <div class="text-block" data-aos="fade-right">
                                    <div class="text-lockup">
                                        <h3>Enjoy our</h3>
                                        <h2>Healthy Options</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                        <a href="">View Products</a>
                                        <i class="icofont-food-basket icofont-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 summer-fun">
                                <div class="large-thumb" data-aos="fade-left"></div>
                                <div class="text-block" data-aos="fade-left">
                                    <div class="text-lockup">
                                        <h2>Summer of Fun</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
<<<<<<< Updated upstream


                        <div class="row bottom-unit">
                            <div class="col-lg-8 merchandise">
                                <div class="large-thumb" data-aos="fade-right"></div>
                                <div class="text-block" data-aos="fade-right">
                                    <div class="text-lockup">
                                        <h3>Helping You</h3>
                                        <h2>Get Involved In Yourself</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillumdolore eu fugiat nulla pariatur.</p>
                                        <a href="">View Merchandise</a>
                                        <i class="icofont-shopping-cart icofont-2x"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 merchandise-pics">
                                <div class="small-thumb-1" data-aos="fade-left"></div>
                                <div class="small-thumb-2" data-aos="fade-left"></div>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="container">

                    <div class="section-title">
                      <span>Other Amenities</span>
                      <h2>Other Amenities</h2>
                    </div>

                    <div class="row">
                      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="icon-box">
                          <div class="icon"><i class="bx bx-wifi"></i></div>
                          <h4><a href="">Wi-Fi</a></h4>
                          <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
                        <div class="icon-box">
                          <div class="icon"><i class="bx bx-closet"></i></div>
                          <h4><a href="">Locker Room</a></h4>
                          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                          <div class="icon"><i class="bx bx-droplet"></i></div>
                          <h4><a href="">Shower Room</a></h4>
                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                      </div>

                    </div>

                  </div>

            </section><!-- End Services Section -->

            <!-- ======= Cta Section ======= -->
            <section id="cta" class="cta">
                <div class="container" data-aos="zoom-in">

                <div class="text-center">
                    <h3>Let's do this together!</h3>
                    <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <a class="cta-btn" href="#">View Rates</a>
                </div>

=======
                            
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                        
                        <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                        </div>
                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif -->
                    @endauth
>>>>>>> Stashed changes
                </div>
            </section><!-- End Cta Section -->

                <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <span>Contact</span>
            <h2>Contact</h2>
            <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
          </div>

          <div class="row" data-aos="fade-up">
            <div class="col-lg-6">
              <div class="info-box mb-4">
                <i class="bx bx-map"></i>
                <h3>Our Address</h3>
                <p style="padding: 15px;">Elizabeth's Happy Corner Remedio Compound, 826 Gov. M. Cuenco Ave, Nasipit Tambalan, Cebu City, 6000 Cebu, Philippines</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="info-box  mb-4">
                <i class="bx bx-envelope"></i>
                <h3>Email Us</h3>
                <p style="padding: 27px;">cebuultimategym@gmail.com</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="info-box  mb-4">
                <i class="bx bx-phone-call"></i>
                <h3>Call Us</h3>
                <p style="padding: 27px;">0905 523 1075</p>
              </div>
            </div>

          </div>

          <div class="row" data-aos="fade-up">

            <div class="col-lg-12">
              <iframe class="mb-4 mb-lg-0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=California Fitness Gym MMXVIII Elizabeth's Happy Corner Remedio Compound, 826 Gov. M. Cuenco Ave, Nasipit Tambalan, Cebu City, 6000 Cebu  &amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

        @include('partials.footer')

    <!-- End Footer -->

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
