<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $message }}</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css" />
    <style>
        html, body {
            height: 100%;
            background: #f9f9f9;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #b0bec5;
            display: table;
            font-weight: 300;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            display: block;
            text-decoration: none;
            color: #b0bec5;
            font-size: 150px;
            margin-bottom: 10px;
            position: relative;
        }

        .title span {
            position: absolute;
            top: 50%;
            display: block;
            width: 100%;
            text-align: center;
        }

        h3 {
            color: #f7362f;
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="content">
            <a href="{{ route('home') }}" class="title">
                <img src="/img/error.gif?{{ random_int(0, PHP_INT_MAX) }}" alt="error" />
                <span>{{ $code }}</span>
            </a>
            <h3>{{ $message }}</h3>
        </section>
    </main>
</body>
</html>