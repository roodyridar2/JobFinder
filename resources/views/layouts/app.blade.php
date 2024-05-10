<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    {{-- our css and js file --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom-bs.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/line-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    @media (max-width: 767px) {
        .navbar-collapse.collapse {
            background-color: rgb(8, 8, 25) !important;
            border-radius: 20px ;
        }
    }
</style>
<body>
    <div id="app">

        <header class="site-navbar mt-3">
            <div class="container text-white">
                <div class="row align-items-center ">
                    <nav class="navbar navbar-expand-lg navbar-light p-2 justify-content-between align-content-between">
                        <a class="navbar-brand text-white" href="{{ route('home') }}">JobBoard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation card">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse    p-2 flex-grow-0 justify-content-around align-content-between" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item text-white">
                                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('contact') }}">Contact</a>
                                </li>
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('login') }}">Log In</a>
                                        </li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('register') }}">Register In</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                            <a class="dropdown-item" href="{{ route('applications') }}">Applications</a>
                                            <a class="dropdown-item" href="{{ route('saves') }}">Saves</a>
                                            <a class="dropdown-item" href="{{ route('cv.edit') }}">Upload CV</a>
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="site-footer bg-dark">
            <div class="container">
                    <div class="">
                        <h1 class="text-white  text-center">AyubJobfinder.com</h1>
                        <ul class="list-unstyled d-flex justify-content-center align-items-center mt-4 "style="gap: 1rem;">
                            <li><a  id="bottom" href="#" class="no-underline"  style="text-decoration: none">HOME</a></li>
                            <li><a href="#" class="no-underline" style="text-decoration: none">ABOUT</a></li>
                            <li><a href="#" class="no-underline" style="text-decoration: none">OTHER</a></li>
                            <li><a href="#" class="no-underline" style="text-decoration: none">LOGIN</a></li>
                            <li><a href="#" class="no-underline" style="text-decoration: none">PROFILE</a></li>
                        </ul>
                        <div class="px-1 d-flex justify-content-center ">
                            <a  class="pt-3 pb-3 pr-3 pl-0 h3 "><span
                                    class="icon-facebook text-white"></span></a>
                            <a  class="pt-3 pb-3 pr-3 pl-0 h3"><span
                                    class="icon-twitter text-white"></span></a>
                            <a  class="pt-3 pb-3 pr-3 pl-0 h3"><span
                                    class="icon-linkedin text-white"></span></a>
                        </div>
                    </div>

            </div>
        </footer>

    </div>

    <!-- SCRIPTS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/stickyfill.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
