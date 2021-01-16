@extends('layouts.auth')


@section('topnav')

<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#services">Services</a></li>
        <li><a href="facility">Facility</a></li>
        <li><a href="products">Products</a></li>
        <li><a href="/#rates">Rates</a></li>
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/home') }}">My Account</a></li>
            @else
            <li class="active"><a href="{{ route('login') }}">Log In</a></li>
            @endauth

        @endif

    </ul>
</nav>

@endsection



@section('content')

    <div class="container">
        <div class="card login-card" data-aos="fade-up">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="{{ asset('images/login.jpg') }}" alt="login" class="login-card-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                         <p class="login-card-description">Sign into your account</p>
                        <form action="{{ route ('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="***********">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" name="login" id="login" class="btn btn-block login-btn mb-4">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="forgot-password-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <p class="login-card-footer-text">Don't have an account? <a href="/#contact" class="text-reset">Contact us</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
