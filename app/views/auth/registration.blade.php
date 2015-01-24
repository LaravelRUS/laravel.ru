@extends('layouts.main')

@section('title', 'Регистрация')

@section('container')
	<main class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<section class="bg-white p-35-45">
					<header>
						<h1 class="text-center">Регистрация</h1>
					</header>
					{{ Form::open(['route' => 'auth.registration.post', 'class' => 'register']) }}
						<input name="jtoken" type="hidden" data-token="{{ $jsToken }}">
						{{ Bootstrap3::input('text', 'username', 'Имя пользователя', null, null, true) }}
						{{ Bootstrap3::password('password', 'Пароль') }}
						{{ Bootstrap3::input('email', 'email', 'Email', null, null, true) }}
						{{ Bootstrap3::button('Зарегистрироваться') }}
						<p>Регистрируясь на сайте, вы автоматически соглашаетесь с <a href="{{ route('pages.rules') }}">правилами</a>.</p>
					{{ Form::close() }}
				</section>
			</div>
		</div>
	</main>
@stop