<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    <meta name="token" content="{!! $token !!}" />
</head>
<body>
    <div id="app"></div>
    <script src="{{ asset_ts('bundle.js') }}"></script>
</body>
</html>
