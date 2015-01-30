<nav role="navigation">
	<div class="container">
		<div class="brand">
			<a href="{{ route('home') }}">Laravel.ru</a>
		</div>
		<ul class="inline float-right">
			<li>
				<a href="{{ route("documentation") }}">Документация</a>
			</li>
			<li>
				<a href="{{ route("documentation") }}">Статьи</a>
			</li>
			<li>
				<a href="{{ route("documentation") }}">Ответы</a>
			</li>
			<li>
				<a href="{{ route("documentation") }}">Пакеты</a>
			</li>
			<li>
				<a href="{{ route("documentation") }}">Cheat Sheet</a>
			</li>
			@if(Auth::check())
				<li>
					<span data-toggle="dropdown">{{ Auth::user()->username }}</span>
					<ul class="dropdown">
						<li>
							<a href="{{ route("user.profile", Auth::user()->username) }}">Профиль</a>
						</li>
						@if(Auth::user()->isAdmin())
							<li>
								<a href="{{ route("admin.users") }}">Новая статья</a>
							</li>
						@endif
						@if(Auth::user()->isLibrarian())
							<li>
								<a href="{{ route("documentation.status") }}">Прогресс перевода</a>
							</li>
						@endif
						<li><a href="{{ route('auth.logout') }}">Выход</a></li>
					</ul>
				</li>
			@else
				<li>
					<a href="{{ route('auth.login') }}">Вход</a>
				</li>
				<li>
					<a href="{{ route('auth.registration') }}">Регистрация</a>
				</li>
			@endif
		</ul>
	</div>
</nav>