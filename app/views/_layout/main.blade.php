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

	<link href="/bootstrap-github/css/bootstrap.css" rel="stylesheet">

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

<div class="navbar navbar-laravel navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#laravel-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="brand-area">
				<a class="navbar-brand" href="/">Русское Laravel сообщество</a>
			</div>
		</div>

		@include("_layout.topmenu")

	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			@include("_layout.partials.flash")
		</div>
	</div>
</div>

@yield("container")

<div class="container">
	<footer>
		<p>&copy; Русское Laravel сообщество <?= date('Y') ?></p>
	</footer>
</div>

</body>
</html>
