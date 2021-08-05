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
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css?ver=5.4.1'
        media='all' />
    <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css?ver=5.4.1'
        media='all' />
    <link href="{{ asset('fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('flatpickr/dist/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script src='https://cdn.ckeditor.com/4.14.0/full/ckeditor.js?ver=5.4.1' defer></script>
    <script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js?ver=5.4.1' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js?ver=5.4.1' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js?ver=5.4.1' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js?ver=5.4.1' defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('flatpickr/dist/flatpickr.min.js') }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/mnz5609571aqhob569whrbbj56etjj47rkm9licdy216mmki/tinymce/5/tinymce.min.js"
        referrerpolicy="origin" defer></script>
    <script src="{{ asset('chart.js/dist/Chart.min.js') }}" defer></script>
    <script src="{{ asset('chart.js/Chart.extension.js') }}" defer></script>
    <script src="{{ asset('js/theme.min.js') }}" defer></script>
    <script src="{{ asset('js/custom-script.js') }}" defer></script>
    

</head>

<body>
    <div id="app">
        <input type="hidden" id="site-public-asset-path" value="{{ asset('/')}}">

        @role('admin')

        @include('dashboard.nav-admin')

        @else

        @include('dashboard.nav')

        @endrole

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@yield('scripts')

</html>