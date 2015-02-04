@extends('layouts.left-sidebar')

@section('title', 'Настройки')
@section('meta-description', 'Описание')

@section('sidebar')
<div class="hidden-xs hidden-sm col-md-3 sidebar">
	@include('partials.widgets.profile', ['profile' => $user])
</div>
@stop

@section('contents')
<div class="col-xs-12 col-md-9">
	<section class="bg-white p-35-45">
		<header>
			<h1>Редактирование профиля</h1>
		</header>
		<hr>
		{{ Form::open(['route' => 'user.edit', 'class' => 'ajax']) }}
			<section>
				<header>
					<h2>Основные данные</h2>
				</header>
				{{ Element::input('text', 'username', 'Логин', null, $user->username, true) }}
				{{ Element::input('email', 'email', 'Email', null, $user->email, true) }}
			</section>
			<section>
				<header>
					<h2 class="h3">Дополнительная информация</h2>
				</header>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						{{ Element::input('text', 'name', 'Имя', null, $user->info->name) }}
					</div>
					<div class="col-xs-12 col-sm-6">
						{{ Element::input('text', 'surname', 'Фамилия', null, $user->info->surname) }}
					</div>
				</div>
				{{ Element::input('date', 'birthday', 'Дата рождения', null, $user->birthday) }}
				{{ Element::textarea('about', 'Обо мне') }}
			</section>
			<section>
				<header>
					<h2 class="h3">Контакты</h2>
				</header>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						{{ Element::input('text', 'website', 'Сайт', null, $user->website) }}
					</div>
					<div class="col-xs-12 col-sm-6">
						{{ Element::input('text', 'skype', 'Skype', null, $user->skype) }}
					</div>
				</div>
			</section>
			{{ Element::button('Сохранить') }}
		{{ Form::close() }}
	</section>
</div>
@stop