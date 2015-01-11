<nav class="navbar topmenu-nav navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#laravel-navbar-collapse">
				<span class="sr-only">Навигация</span>
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
				@if(Auth::check())
					<li>
						<a href="#" data-toggle="dropdown">{{{ Auth::user()->name }}}
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{{ route("user.profile", Auth::user()->name) }}}">Мой профайл</a></li>
							@if(Auth::user()->isAdmin())
								<li class="divider"></li>
								<li><a href="{{{ route("admin.users") }}}">Список пользователей</a></li>
							@endif
							@if(Auth::user()->isLibrarian())
								<li><a href="{{{ route("documentation.updates") }}}">Прогресс перевода</a></li>
							@endif
							<li class="divider"></li>
							<li><a href="{{{ route('auth.logout') }}}">Выход</a></li>
						</ul>
					</li>
				@else
					<li><a href="{{{ route('auth.login') }}}">Вход</a></li>
					<li><a href="{{{ route('auth.registration') }}}">Регистрация</a></li>
				@endif
			</ul>
		</div>
	</div>
</nav>