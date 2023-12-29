<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') &mdash; {{ config('app.name', 'Laravel') }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">

    <nav class="py-2 bg-body-tertiary border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link link-body-emphasis px-2 active" aria-current="page">Home</a>
                </li>
                <!--
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">About</a></li>
                -->
            </ul>
            <ul class="nav">
                @guest
                    <li class="nav-item"><a href="#login" class="nav-link link-body-emphasis px-2">{{ __('user.login') }}</a></li>
                    <li class="nav-item"><a href="#register" class="nav-link link-body-emphasis px-2">{{ __('user.register') }}</a></li>
                @else
                    <li class="nav-item"><a href="#logout" class="nav-link link-body-emphasis px-2">{{ __('user.logout') }}</a></li>
                @endguest
            </ul>
        </div>
  </nav>

    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="{{ route('home') }}" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Laravel App</span>
            </a>
        </div>
    </header>

    <div class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @if (app()->environment('local'))
        <div class="text-center">
            <a href="/telescope"><img src="{{ asset('vendor/telescope/favicon.ico') }}" width="20" alt="telescope"> Telescope</a>
        </div>
    @endif

</div>
</body>
</html>
