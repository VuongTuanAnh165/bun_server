<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @yield('meta')

    @vite(['resources/assets/css/mediox.css', 'resources/assets/js/mediox.js'])
    @stack('styles')
    @stack('head')
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image" style="background-image: url(assets/images/loader.png);"></div>
    </div>

    <div class="page-wrapper">
        @includeWhen(View::exists('layouts.navbar'), 'layouts.navbar')

        @yield('content')

        @includeWhen(View::exists('layouts.footer'), 'layouts.footer')
    </div>
    @includeWhen(View::exists('layouts.mobile-menu'), 'layouts.mobile-menu')

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form role="search" method="get" class="search-popup__form" action="#">
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="mediox-btn">
                    <i class="icon-search"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__text">back top</span>
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    </a>

    @stack('scripts')
</body>

</html>