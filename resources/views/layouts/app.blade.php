<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styleBeranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylecontent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleslider.css') }}">

    <!-- Optional JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        @include('layout.navbar')
        <!-- Navbar -->

        <main class="py-4">
            @yield('content')
            <!-- Content will be inserted here -->
        </main>


    </div>
    @include('layout.footer')
</body>

</html>