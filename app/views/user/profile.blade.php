@extends('layouts.nosidebar')

@section('title')
Пользователь
@stop

@section('content')

<div class="row">
    <div class="col-md-4">
        <h3>{{ $user->username }}</h3>
        <p>
            <br><br>Аватар<br><br>
        </p>
        @if($user->isAdmin()) <span class="text-danger">Администратор</span> @endif
        @if($user->isModerator()) <span class="text-danger">Модератор</span> @endif
        <p>Зарегистрировался: {{ $user->created_at->format('d M Y') }}</p>
        <p>Последняя активность: {{ $user->created_at->format('d M Y') }}</p>
        <p>Статей: {{ $user->posts()->notDraft()->count() }}</p>
        <p>Комментариев: {{ $user->comments()->count() }}</p>
        <p>Новостей предложено: 0</p>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <p>О себе: {{ $user->info->about }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	            @if($user->social->vkontakte)
                <p>{{ trans('social.vkontakte') }}: <a href="http://vk.com/{{ $user->social->vkontakte }}">{{ $user->social->vkontakte }}</a></p>
	            @endif
	            @if($user->social->twitter)
                <p>{{ trans('social.twitter') }}: <a href="http://twitter.com/{{ $user->social->twitter }}">{{ $user->social->twitter }}</a></p>
	            @endif
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>

<ul class="nav nav-tabs">
    <li class="active">Статьи</li>
	<li>Новости</li>
	<li>Черновики</li>
</ul>

@stop
