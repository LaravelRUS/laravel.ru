<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>@yield('title', "Laravel.ru")</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">
<!--    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>-->
<!--    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>-->
    <!-- Global CSS -->
<!--    <link rel="stylesheet" href="/tempo/plugins/bootstrap/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/bootstrap-github/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/tempo/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/tempo/plugins/animate-css/animate.min.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="/app/css/style_tempo.css">
<!--    <link id="theme-style" rel="stylesheet" href="/tempo/css/styles-9.css">-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/tempo/plugins/jquery-1.10.2.min.js"></script>
</head>

<body>
<div class="wrapper">
    <!-- ******HEADER****** -->
    <header id="header" class="header">
        <div class="container">
            <h1 class="logo pull-left">
                <a href="<?= route("home") ?>">
                    <span class="logo-title">Laravel.ru</span>
                </a>
            </h1><!--//logo-->
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <?if(Auth::user()->isAdmin()){?>
                            <li class="nav-item"><a href="<?= route("admin") ?>">Админка</a></li>
                        <?}?>
                        <li class="active nav-item"><a href="<?= route("docs") ?>">Документация</a></li>
                        <li class="nav-item"><a href="<?= route("docs") ?>">Статьи</a></li>
                        <li class="nav-item"><a href="<?= route("docs") ?>">Форум</a></li>
                        <li class="nav-item"><a href="https://gitter.im/LaravelRUS/chat" target="_blank">Чат</a></li>
                        <?if(Auth::check()){?>
                        <li class="nav-item"><a href="<?= route('user.blog', [Auth::user()->name]) ?>"><b><?= Auth::user()->name ?></a></b></li>
                        <li class="nav-item last"><a href="<?= route('auth.logout') ?>">Выход</a></li>
                        <?}else{?>
                        <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-primary" href="<?= route("auth.login") ?>">Вход</a></li>
                        <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-primary" href="<?= route("auth.registration") ?>">Регистрация</a></li>
                        <?}?>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div><!--//container-->
    </header><!--//header-->

    @yield("container")

</div><!--//wrapper-->

<!-- ******FOOTER****** -->
<footer class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-5 col-sm-7 col-sm-12 about">
                    <div class="footer-col-inner">
                        <h3 class="title">Знаете ли вы ?</h3>
                        <p>В метод User::find() можно передавать массив id:<br>
                        // Получить всех пользователей с ID от 1 до 10<br>
                        $users = User::find(range(1,10));</p>
                        <p><a class="more" href="#">Читать дальше <i class="fa fa-long-arrow-right"></i></a></p>

                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                <div class="footer-col col-md-3 col-sm-4 col-md-offset-1 links">
                    <div class="footer-col-inner">
                        <h3 class="title">Полезные ссылки</h3>
                        <ul class="list-unstyled">
                            <li><a href="http://laravel.com"><i class="fa fa-caret-right"></i>laravel.com</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Jobs</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Press</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Terms of services</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Privacy Policy</a></li>
                        </ul>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                <div class="footer-col col-md-3 col-sm-12 contact">
                    <div class="footer-col-inner">
                        <h3 class="title">Присоединяйся</h3>
                        <div class="row">
                            <p class="email col-md-12 col-sm-4"><i class="fa fa-vk"></i><a href="https://vk.com/laravel_rus">Сообщество во Вконтакте</a></p>
                            <p class="email col-md-12 col-sm-4"><i class="fa fa-twitter"></i><a href="https://twitter.com/LaravelRUS">Твиттер</a></p>
                            <p class="email col-md-12 col-sm-4"><i class="fa fa-comment"></i><a href="https://gitter.im/LaravelRUS/chat">Gitter чат</a></p>
                        </div>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
            </div><!--//row-->
        </div><!--//container-->
    </div><!--//footer-content-->
    <div class="bottom-bar">
        <div class="container">
            <div class="row">
                <small class="copyright col-md-6 col-sm-6 col-xs-12">Copyright @ 2014 Русскоязычное комьюнити Laravel | Website template by 3rd Wave Media</small>
                <ul class="social col-md-6 col-sm-6 col-xs-12 list-inline">

                    <li><a href="https://www.facebook.com/LaravelRus" ><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/LaravelRUS" ><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://vk.com/laravel_rus" ><i class="fa fa-vk"></i></a></li>

                </ul><!--//social-->
            </div><!--//row-->
        </div><!--//container-->
    </div><!--//bottom-bar-->
</footer><!--//footer-->

<!-- Javascript -->
<script type="text/javascript" src="/tempo/plugins/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/tempo/plugins/detectmobilebrowser.js"></script>
<script type="text/javascript" src="/tempo/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/tempo/plugins/back-to-top.js"></script>
<script type="text/javascript" src="/tempo/plugins/jquery-placeholder/jquery.placeholder.js"></script>
<script type="text/javascript" src="/tempo/plugins/jquery-inview/jquery.inview.min.js"></script>
<!--<script type="text/javascript" src="/tempo/plugins/FitVids/jquery.fitvids.js"></script>-->
<script type="text/javascript" src="/tempo/js/main.js"></script>
<!--[if !IE]>-->
<!--<script type="text/javascript" src="/tempo/js/animations.js"></script>-->
<!--<![endif]-->
</body>
</html>