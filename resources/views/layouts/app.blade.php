<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>product management</title>
        @vite(['resources/css/app.css','resources/js/app.js'])

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @include('components.navbar')
        <div class="container-lg mx-auto">
            @yield('main')
        </div>
    </body>
</html>
