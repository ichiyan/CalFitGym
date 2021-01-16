@extends('layouts.main')

@section('topnav')

<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#services">Services</a></li>
        <li class="active"><a href="facility">Facility</a></li>
        <li><a href="products">Products</a></li>
        <li><a href="/#rates">Rates</a></li>
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/home') }}">My Account</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Log In</a></li>
            <li><a href="{{ route('register') }}">Register</a></li><!-- Here for testing. Remove later -->
            @endauth

        @endif

    </ul>
</nav>

@endsection


@section('hero')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
    <h1>Our Facility</h1>
    <h2>with modern quality equipment to help you get fit</h2>
    <a href="#facility" class="btn-get-started scrollto">View Gallery</a>
    </div>
</section><!-- End Hero -->

@endsection

@section('main')

<main id="main">

    <section id="facility" class="portfolio">
        <div class="container">

          <div class="section-title">
            <span>Facility</span>
            <h2>Facility</h2>
            <p>SOME INSPIRING STUFF</p>
          </div>

          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="150">

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-3.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-4.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-5.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-6.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-8.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-10.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-11.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Heading</h4>
                <p>short-description</p>
              </div>
            </div>

          </div>

        </div>
      </section>

</main><!-- End #main -->

@endsection


