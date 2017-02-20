<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="X-DNS-Prefetch-Control" content="on" />

    <title>{{ config('app.name') }}</title>

    <link rel="dns-prefetch" href="{{ config('app.url') }}" />
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700,700i|Roboto+Mono:400,700&amp;subset=cyrillic" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset_ts('app.css') }}" />

    <script async="async" src="{{ asset_ts('app.js') }}"></script>

    @stack('head')
</head>
<body style="opacity: 0" class="@stack('body-class')">
    @section('header')
        @include('partials.header')
        @stack('header')
    @show

    @yield('content')

    @section('footer')
        @stack('footer')
        @include('partials.footer')
    @show
</body>
</html>
