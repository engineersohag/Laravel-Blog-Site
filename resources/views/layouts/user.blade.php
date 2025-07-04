<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <title>Blog Site Task</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- {{-- bootstrap --}} -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('style.css') }}"> 

    <style>
        nav ul li.nav-item a{
            font-size: 18px;
            text-transform: uppercase;
            color: #fff;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('sweetalert::alert')
    <div id="app">
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                  <a class="navbar-brand text-light" href="{{ url('/')}}">
                    <h2>Blog <strong class="text-warning">Site</strong> Task<strong class="text-warning">.</strong></h2>
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navs" aria-controls="navs" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navs">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li>
                        
                        @if (Auth::id())
                            <li class="nav-item">
                                <a href="{{ route('user.blog.add') }}" class="nav-link {{ request()->routeIs('user.blog.add') ? 'active' : '' }}">
                                    Create Blog
                                </a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="{{ route('user.blogs') }}" class="nav-link {{ request()->routeIs('user.blogs') ? 'active' : '' }}">
                                    My Blog
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->usertype=="admin")
                                    <a class="dropdown-item text-dark" href="{{ route('home') }}">
                                        Dashboard
                                    </a>
                                    @endif
                                    <a class="dropdown-item text-dark" href=""
                                       onclick="event.preventDefault();
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
                </div>
            </nav>
        </div>

        <main class="">
            @yield('content')
            
        </main>
    </div>

    

    <!-- Footer Start -->
    <footer class="bg-dark text-white pt-4 pb-2">
        <div class="container text-center">
        <h5 class="mb-2">Follow Us</h5>
        <div class="d-flex justify-content-center gap-2 mb-2">
            <a href="https://www.youtube.com/" target="_blank" class="text-white fs-1 me-4">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="https://www.facebook.com/" target="_blank" class="text-white fs-1 me-4">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="text-white fs-1 me-4">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/" target="_blank" class="text-white fs-1 me-4">
                <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="https://x.com/" target="_blank" class="text-white fs-1 me-4">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="https://github.com/" target="_blank" class="text-white fs-1">
                <i class="fa-brands fa-github"></i>
            </a>
        </div>
        <p class="mb-0">&copy; 2025 <a href="{{url('/')}}">Blog <strong class="text-warning">Site</strong> Task<strong class="text-warning">.</strong></a> All rights reserved.</p>
        </div>
    </footer>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
