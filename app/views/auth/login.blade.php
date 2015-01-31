@extends('layouts.main')

@section('title', 'Вход')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<main class="bg-white p-45 popup">
					<article>
						<header class="text-center">
							<h1>Авторизация</h1>
						</header>
						@include('partials.error', ['field' => 'wrong_input'])
						{{ Form::open(['route' => 'auth.login.post']) }}
							{{ Element::input('text', 'login', 'Логин или Email', null, null, true) }}
							{{ Element::password() }}
							{{ Element::button('Войти') }}
						{{ Form::close() }}
					</article>
				</main>
			</div>
		</div>
	</div>
@stop