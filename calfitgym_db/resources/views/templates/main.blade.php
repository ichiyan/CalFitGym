<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>{{config('app.name', 'California Fitness Gym')}}</title>

        <!-- Styles -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- JS -->
        <script_src = "{{asset('js/app.js')}}" defer></script>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">{{config('app.name', 'California Fitness Gym')}}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    </ul>
                    <!--<form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                    <div class="form-inline my-2 my-lg-0">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">Login</a>

                                    <!-- @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif -->
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="container">
            @yield('content')
        </main>

    </body>
</html>
