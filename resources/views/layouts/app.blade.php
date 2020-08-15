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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="sidebar-container col-sm-12 col-md-2 col-lg-2 col-xl-2 pr-0 position-fixed big-desktop">
            @include('_partials.sidebar')
            <div class="sidebar-footer vh-100">
                <a href="">
                <span class="sidebar-settings text-white text-center border-right 100 float-left">
                    <i class="uil uil-setting"></i>
                </span>
                </a>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <span class="sidebar-logout text-white text-center float-right">
                        <i class="uil uil-sign-out-alt"></i>
                    </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->logo != null)
                                        <img src="{{asset(Auth::user()->logo)}}" class="user-profile-img rounded-circle" alt="user logo">
                                    @else
                                        <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                                    @endif
                                        @auth('web')
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        @else
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                        @endauth
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="/profile" role="button">
                                        Profile <span class="caret"></span>
                                    </a>
                                </div>




                                <div class="mobile">
                                    @auth('web')
                                        <a class="nav-link" href="/dashboard" role="button">
                                            Dashboard <span class="caret"></span>
                                        </a>

                                        <a class="nav-link" href="/company/clients" role="button">
                                            Clients <span class="caret"></span>
                                        </a>

                                        <a class="nav-link" href="/company/estimates" role="button">
                                            Estimates <span class="caret"></span>
                                        </a>

                                        <a class="nav-link" href="/company/invoices" role="button" >
                                            Invoices <span class="caret"></span>
                                        </a>
                                    @else
                                        <a class="nav-link" href="/dashboard" role="button">
                                            Dashboard <span class="caret"></span>
                                        </a>

                                        <a class="nav-link" href="/client/estimates" role="button">
                                            Estimates <span class="caret"></span>
                                        </a>

                                        <a class="nav-link" href="/client/invoices" role="button" >
                                            Invoices <span class="caret"></span>
                                        </a>
                                    @endauth

                                </div>

                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 main">
            @yield('content')
        </main>
    </div>
</body>
</html>
