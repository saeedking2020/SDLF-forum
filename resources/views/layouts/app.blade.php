<?php

use App\Models\Setting;

$settings = Setting::latest()->first();
?>
    <!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Saeed Doozandeh Laravel Forum">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

    {{--    CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SDLF') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">


    <!-- Scripts -->
</head>
<body>
<div class="container-fluid">
    <!-- First section -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h1>
                @if($settings)
                    <a href="/" class="navbar-brand">{{$settings->forum_name}}</a>
                @else
                    <a href="/" class="navbar-brand">Saeed Laravel Forum</a>
                @endif
            </h1>
            <form action="{{route('category.search')}}" method="post" class="form-inline mr-3 mb-2 mb-sm-0">
                @csrf
                <input type="text" class="form-control" name="keyword" placeholder="Search Category"/>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-success" id="button-addon2"><i
                            class="fa fa-search"></i></button>
                </div>
            </form>

            @guest
                <a class="nav-item nav-link text-white btn btn-dark" href="{{route('login')}}">Login</a>
                <a class="nav-item nav-link text-white btn btn-dark" href="{{route('register')}}">Register</a>
                <a class="nav-item nav-link text-white btn btn-dark" href="{{route('about')}}">About</a>
            @endguest
            <a class="nav-item nav-link text-white">
                @auth
                    <a href="{{route('dashboard.home')}}" class="btn btn-outline-secondary text-white">Admin Panel</a>
                    <a href="{{route('home')}}" class="btn btn-outline-secondary text-white"> Dashboard</a>
                    <form id="logout-form" action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                    <a class="nav-item nav-link text-white btn btn-dark" href="{{route('about')}}">About</a>
                @endauth
            </a>
        </div>
    </nav>

    <!-- first section end -->
</div>
<div class="container">
{{--    <nav class="breadcrumb">--}}
{{--        <a href="{{route('home')}}" class="breadcrumb-item active"> Dashboard</a>--}}
{{--    </nav>--}}
<div class="mb-3"></div>

    @yield('content')
    <!-- Authentication Links -->
    {{--                        @guest--}}
    {{--                            @if (Route::has('login'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}

    {{--                            @if (Route::has('register'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}
    {{--                        @else--}}
    {{--                            <li class="nav-item dropdown">--}}
    {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--                                    {{ Auth::user()->name }}--}}
    {{--                                </a>--}}

    {{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
    {{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
    {{--                                       onclick="event.preventDefault();--}}
    {{--                                                     document.getElementById('logout-form').submit();">--}}
    {{--                                        {{ __('Logout') }}--}}
    {{--                                    </a>--}}

    {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
    {{--                                        @csrf--}}
    {{--                                    </form>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                        @endguest--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </nav>--}}

    {{--        <main class="py-4">--}}
    {{--            @yield('content')--}}
    {{--        </main>--}}
</div>
<div class="container-fluid">
    <footer class="small bg-dark text-white">
        <div class="container py-4">
            <ul class="list-inline mb-0 text-center">
                <li class="list-inline-item">
                    &copy; 2025 Saeed's forum
                </li>
                <li class="list-inline-item">All rights reserved</li>
                <li class="list-inline-item">Terms and privacy policy</li>
            </ul>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
