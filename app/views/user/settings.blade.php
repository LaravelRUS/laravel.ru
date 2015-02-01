@extends('layouts.profile')

@section('title', 'Настройки')
@section('meta-description', 'Описание')

@section('contents')
	<section class="bg-white p-35-45">
		<header>
			<h1>Редактирование профиля</h1>
		</header>
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
					<h2>Дополнительная информация</h2>
				</header>
				<div class="row">
					<div class="col-xs-6">
						{{ Element::input('text', 'name', 'Имя', null, $user->info->name) }}
					</div>
					<div class="col-xs-6">
						{{ Element::input('text', 'surname', 'Фамилия', null, $user->info->surname) }}
					</div>
				</div>
				{{ Element::input('date', 'birthday', 'Дата рождения', null, $user->birthday) }}
				<label for="about">Обо мне</label>
				<textarea name="about" id="about" rows="5">{{ $user->info->about }}</textarea>
			</section>
			<section>
				<header>
					<h2>Контакты</h2>
				</header>
				<div class="row">
					<div class="col-xs-6">
						{{ Element::input('text', 'website', 'Сайт', null, $user->website) }}
					</div>
					<div class="col-xs-6">
						{{ Element::input('text', 'skype', 'Skype', null, $user->skype) }}
					</div>
				</div>
			</section>
			{{ Element::button('Сохранить') }}
		{{ Form::close() }}
	</section>
@stop