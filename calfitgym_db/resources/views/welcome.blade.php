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
        <div>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <main>
            @yield('content')
        </main>
        <h1>BONA was here EHE </h1>
    </body>
</html>
