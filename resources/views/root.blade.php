<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ config('app.icon') ? asset('storage/' . config('app.icon')) : null }}">

        <!-- Scripts -->
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
        @spladeHead
    </head>
    <body class="tw-relative tw-font-sans tw-antialiased">
        @splade
    </body>
</html>
