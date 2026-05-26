<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <div id="app" data-authenticated="{{ auth()->check() ? '1' : '0' }}"
        data-user-email="{{ auth()->user()?->usuario_email ?? '' }}"
        data-user-name="{{ auth()->user()?->usuario_nombres ?? '' }}"></div>
</body>

</html>
