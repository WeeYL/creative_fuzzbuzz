<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class=" d-flex navbar navbar-expand-lg navbar-light bg-info shadow-sm">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                {{-- creative logo --}}
                <div class='d-flex flex-column '>

                    <a class="font-weight-bold text-dark " href="{{ url('/') }}">
                        <h1 >
                            Creative Fuzz Buzz
                        </h1> 
                    </a>
                    <p>
                        Explore fantastical worlds and original characters from Creative Fuzz Buzz <br>
                        community of comics creators and illustrators.
                    </p>
                </div>
                    
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </h5>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </h5>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        
                            <a style="font-size:25px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                        <a class="dropdown-item" href={{"/profile/" . Auth::user()->id}}> My Profile</a> 
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                               
                                
       

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
