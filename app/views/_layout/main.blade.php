<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.ico">

	<title>@yield('title', "LaravelRUS")</title>

	<!-- Bootstrap core CSS -->
<!--	<link href="/bootstrap-todc/css/bootstrap.css" rel="stylesheet">-->
<!--	<link href="/bootstrap-todc/css/todc-bootstrap.css" rel="stylesheet">-->

	<link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

	<link href="/app/css/style.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="/bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


	<!-- Bootstrap core JavaScript
================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="/vendor/jquery/jquery-1.11.1.min.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>

<!--	<script src="/vendor/ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>-->
<!--	<script>-->
<!--		$(document).ready(function() {-->
<!--			var editor = ace.edit("ace-editor");-->
<!--			editor.setTheme("ace/theme/crimson_editor");-->
<!--			editor.getSession().setMode("ace/mode/php");-->
<!--		});-->
<!--	</script>-->

</head>

<body>

<div class="navbar topmenu-nav navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#laravel-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="brand-area">
				<a class="navbar-brand" href="/">Laravel.ru</a>
			</div>
		</div>

		<div class="navbar-collapse collapse" id="laravel-navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?= route("documentation") ?>">Документация</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?if(Auth::check()){?>
					<li>
						<a href="#" data-toggle="dropdown"><?= Auth::user()->name ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= route("user.profile", Auth::user()->name) ?>">Мой профайл</a></li>
							<?if(Auth::user()->isAdmin()){?>
								<li class="divider"></li>
								<li><a href="<?= route("admin.users") ?>">Список пользователей</a></li>
							<?}?>
							<?if(Auth::user()->isLibrarian()){?>
								<li><a href="<?= route("documentation.updates") ?>">Прогресс перевода</a></li>
							<?}?>
							<li class="divider"></li>
							<li><a href="<?= route('auth.logout') ?>">Выход</a></li>
						</ul>
					</li>
				<?}else{?>
					<li><a href="<?= route('auth.login') ?>">Вход</a></li>
					<li><a href="<?= route('auth.registration') ?>">Регистрация</a></li>
				<?}?>
			</ul>
		</div><!--/.nav-collapse -->

	</div>
</div>

@yield("submenu")

@yield("container")


<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
				<div class="footer-group">
					<h4>Присоединяйтесь</h4>
					<ul>
						<li><a href="https://gitter.im/LaravelRUS/chat" >Чат в Gitter</a></li>
						<li><a href="https://vk.com/laravel_rus" >Сообщество Вконтакте</a></li>
						<li><a href="https://twitter.com/LaravelRUS" >Твиттер</a></li>
					</ul>
				</div>
				<?if(Auth::check() AND Auth::user()->isAdmin()){?>
					<div class="footer-group">
						<h4>Админка</h4>
						<ul>
							<li><a href="https://gitter.im/LaravelRUS/chat" >Чат в Gitter</a></li>
						</ul>
					</div>
				<?}?>
			</div>
		</div>

	</div>
</footer>


</body>
</html>
