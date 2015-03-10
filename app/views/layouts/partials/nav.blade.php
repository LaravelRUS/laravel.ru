<nav {{ navMargin() }} role="navigation">
	<div class="container">
		<div class="header">
			<div class="brand">
				<a href="{{ route('home') }}">Laravel.su</a>
			</div>
			<div class="float-right toggle-button">
				<i class="fa fa-lg fa-bars"></i>
			</div>
		</div>
		<div class="collapse">
			<ul>
				<li {{ activeClass('documentation', 'documentation.status') }}>
					<a href="{{ route('documentation') }}">Документация</a>
				</li>
				{{--<li {{activeClass(['articles.all'])}}>--}}
					{{--<a href="{{ route("articles.all") }}">Статьи</a>--}}
				{{--</li>--}}
				{{--<li>--}}
					{{--<a href="{{ route("documentation") }}">Вопросы</a>--}}
				{{--</li>--}}
				{{--<li class="hidden-sm">--}}
					{{--<a href="{{ route("documentation") }}">Пакеты</a>--}}
				{{--</li>--}}
				{{--<li>--}}
					{{--<a href="{{ route("documentation") }}">Cheat Sheet</a>--}}
				{{--</li>--}}
				<li class="hidden-sm">
					<a href="https://gitter.im/LaravelRUS/chat" rel="nofollow" target="_blank">Чат</a>
				</li>
				<li {{ activeClass('users') }}>
					<a href="{{ route('users') }}">Пользователи</a>
				</li>
				@if(Auth::check())
					<li>
						<span data-toggle="dropdown">{{ Auth::user()->username }}</span>
						<ul class="dropdown">
							<li>
								<a href="{{ route('user.profile', Auth::user()->username) }}">Профиль</a>
							</li>
							<li>
								<a href="{{ route('articles.create') }}">Добавить статью</a>
							</li>
							@if(Auth::user()->isAdmin())
								<li>
									<a href="{{ route('admin.users') }}">Список пользователей</a>
								</li>
							@endif
							@if(Auth::user()->isLibrarian())
								<li>
									<a href="{{ route('documentation.status') }}">Прогресс перевода</a>
								</li>
							@endif
							<li><a href="{{ route('auth.logout') }}">Выход</a></li>
						</ul>
					</li>
				@else
					<li>
						<a href="{{ route('auth.login') }}">Вход</a>
					</li>
					<li class="hidden-sm">
						<a href="{{ route('auth.registration') }}">Регистрация</a>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>
