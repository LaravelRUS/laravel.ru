<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">Laravel.su</a>
</div>
<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
		<li><a href="<?= route('news') ?>">Новости</li>
		<li><a href="<?= route('articles') ?>">Статьи</a></li>
		<li><a href="<?= route('tricks') ?>">Фишки</a></li>
		<li><a href="<?= route('forum') ?>">Форум</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><a href="<?= route('auth.login') ?>">Вход</a></li>
	</ul>
</div><!--/.nav-collapse -->