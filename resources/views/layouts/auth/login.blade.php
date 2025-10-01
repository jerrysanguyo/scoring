<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/webp" href="{{ asset('image/logo.webp') }}">
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-1bd03d06.css') }}">
    <script src="{{ asset('build/assets/app-de464e6f.js') }}"></script>
    <style>
        .btn.btn-primary {
            background-color: #727CF5;
            border-color: #727CF5;
        }
        
        body {
            background: url('{{ asset("image/bg.webp") }}') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>