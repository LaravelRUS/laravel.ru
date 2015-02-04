@extends('layouts.main')

@section('title', 'Вход')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
				<main class="bg-white popup">
					<article>
						<aside class="header-icon">
							<i class="fa fa-user-secret"></i>
						</aside>
						<header class="text-center">
							<h1>Авторизация</h1>
						</header>
						@include('partials.error', ['field' => 'wrong_input'])
						<hr>
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