<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Brygada+1918:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('asset/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('asset/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

    <title>Sterial &mdash; @yield('title') </title>
</head>

<body>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav mt-3">
        <div class="container">

            <div class="site-navigation">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <a href="{{ route('home.index') }}" class="logo m-0 float-start">Sterial</a>
                    </div>
                    <div class="col-lg-6 d-none d-lg-inline-block text-center nav-center-wrap">
                        <ul class="js-clone-nav  text-center site-menu p-0 m-0">
                            <li class="active"><a href="{{ route('home.index') }}">
                                    Home</a></li>
                            <li><a href="{{ route('home.about') }}">
                                    About us</a></li>
                            <li><a href="{{ route('home.services') }}">
                                    Services</a></li>
                            <li><a href="{{ route('home.blog') }}">
                                    Blog</a></li>
                            <li><a href="">
                                    Login</a></li>

                        </ul>
                    </div>
                    <div class="col-6 col-lg-3 text-lg-end">
                        <ul class="js-clone-nav d-none d-lg-inline-block text-end site-menu ">
                            <li class="cta-button"><a href="{{ route('home.contact') }}">Contact Us</a></li>
                        </ul>

                        <a href="#"
                            class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light"
                            data-toggle="collapse" data-target="#main-navbar">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>

    @yield('content')
    @include('layout.footer')
