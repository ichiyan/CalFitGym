@extends('layouts.main')

@section('topnav')

<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#services">Services</a></li>
        <li class="active"><a href="facility">Facility</a></li>
        <li><a href="/products/1">Products</a></li>
        <li><a href="/#rates">Rates</a></li>
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/home') }}">My Account</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Log In</a></li>
            {{-- <li><a href="{{ route('register') }}">Register</a></li><!-- Here for testing. Remove later --> --}}
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
    <h2>with modern quality equipments to help you get fit</h2>
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
            <p>State of the art equipments, dedicated coaches. Our gym desires to fulfill the wishes and goals our members want to achieve.</p>
          </div>

          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="150">

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Wings/Back Build Up Section</h4>
                <p>Tone the muscles found in one of the most difficult area with our state of the art equipments.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Arm Toning Section</h4>
                <p>Our gym acquired dumbells of different weights and lengths in order to accomodate each of our members' needs.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-3.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Arm Build Up Section</h4>
                <p>For those who wants to more than just a simple tone in their upper body and wishes increase the size of their muscles, these section is the way to go.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-4.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Treadmill Section</h4>
                <p>Our gym contains an ample amount of treadmill to accomodate members who want to increase their stamina.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-5.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Leg Workout Section</h4>
                <p>Tone those leg muscles or increase your jumping prowess with our state-of-the-art equipments. </p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-6.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Cardio Section</h4>
                <p>Increase your stamina and shred those excess fats by using our equipments meant for those reasons.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-8.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weighlifting Section</h4>
                <p>A section of our gym specifically for body builders.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-10.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Locker Room</h4>
                <p>For our gym, safety and security is one of our priority. Thus, we have a locker room to put your things while you tone up and build up those muscles.</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('images/facility/fac-11.png') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Shower Room</h4>
                <p>After a workout, a bath is required in order to rid yourself of those sweat and stenches. So when you leave our gym, you are refreshed, clean and a step closer to that dream body.</p>
              </div>
            </div>

          </div>

        </div>
      </section>

</main><!-- End #main -->

@endsection


