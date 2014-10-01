<div class="navbar-collapse collapse" id="laravel-navbar-collapse">
	<ul class="nav navbar-nav">
		<li><a href="<?= route("documentation") ?>">Документация</a></li>
		<?if(allowEditTerms()){?><li><a href="<?= route("terms") ?>">Термины</a></li><?}?>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<?if(Auth::check()){?>
			<li><a href="<?= route('user.blog', [Auth::user()->name]) ?>">Блог</a></li>
			<li><a href="<?= route('auth.logout') ?>">Выход</a></li>
		<?}else{?>
			<li><a href="<?= route('auth.login') ?>">Вход</a></li>
			<li><a href="<?= route('auth.registration') ?>">Регистрация</a></li>
		<?}?>
	</ul>
</div><!--/.nav-collapse -->