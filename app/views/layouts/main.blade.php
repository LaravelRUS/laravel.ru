<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('meta-description')">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="no-gutter">
	@include('layouts.partials.nav')
	@yield('submenu')
	@yield('container')
	@include('layouts.partials.footer')

	<script src="{{ asset('js/script.min.js') }}"></script>
	@yield('scripts')
	@include('layouts.partials.counter')
</body>
</html>
