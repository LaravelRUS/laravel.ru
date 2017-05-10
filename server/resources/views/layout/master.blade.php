<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="X-DNS-Prefetch-Control" content="on" />
    <meta name="keywords" content="@stack('keywords')" />
    <meta name="description" content="@stack('description')" />
    <meta name="token" content="{!! $token !!}" />
    <title>@stack('title'){{ config('app.name') }}</title>
    <link rel="dns-prefetch" href="{{ config('app.url') }}" />
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset_ts('app.css') }}" />
    <script async="async" src="{{ asset_ts('app.js') }}"></script>
    @stack('head')
</head>
<body class="@stack('body-class')">
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
