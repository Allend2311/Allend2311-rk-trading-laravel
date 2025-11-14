<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RK Trading') }} - @yield('title', 'Affordable Solar Lights & Fans')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body class="antialiased">
    @include('layouts.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>
