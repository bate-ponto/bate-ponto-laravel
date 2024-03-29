<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <script src="{{ asset('js/app.js') }}"></script>

    @livewireStyles
</head>

<body class="w-screen h-screen flex">
    {{ $slot }}

    @livewireScripts
</body>

</html>
