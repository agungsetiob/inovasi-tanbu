<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.title') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="background relative">
    <div class="absolute top-0 left-0 p-6">
        <img src="{{ asset('img/garuda.png') }}" class="w-16 h-16">
    </div>
    <div class="absolute top-0 right-0 p-6">
        <img src="{{ asset('img/logo.png') }}" class="w-16 h-16">
    </div>
    <div class="font-sans text-white antialiased">
        {{ $slot }}
    </div>
</body>
</html>
