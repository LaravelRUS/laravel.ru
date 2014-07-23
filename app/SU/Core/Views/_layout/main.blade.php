<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../../../../public/favicon.ico">

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

		@include("_layout/_topmenu")

	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			@include("_layout/partials/flash")
		</div>
	</div>
</div>

@yield("container")

<div class="container">
	<footer>
		<p>&copy; Русское Laravel сообщество <?= date('Y') ?></p>
	</footer>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/vendor/jquery/jquery-1.11.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>

<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=13104421&amp;from=informer"
   target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/13104421/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                       style="width:1px; height:1px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:13104421,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter13104421 = new Ya.Metrika({id:13104421,
					webvisor:true,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					ut:"noindex"});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/13104421?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
