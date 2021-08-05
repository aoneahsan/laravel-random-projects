<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png" sizes="16x16">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/theme.min.js') }}" defer></script>
    
</head>

<body>