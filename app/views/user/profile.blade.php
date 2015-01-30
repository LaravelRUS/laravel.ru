@extends('layouts.nosidebar')

@section('title')
Пользователь
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $user->username }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <p><img src="{{ $user->avatar }}" alt="{{ $user->name }}"/></p>
        @if($user->isAdmin()) <span class="text-danger">Администратор</span> @endif
        @if($user->isModerator()) <span class="text-danger">Модератор</span> @endif
        <p>Зарегистрировался: {{ $user->created_at->format('d M Y') }}</p>
        <p>Последняя активность: {{ $user->created_at->format('d M Y') }}</p>
        <p>Статей: {{ $user->posts()->notDraft()->count() }}</p>
        <p>Комментариев: {{ $user->comments()->count() }}</p>
        <p>Новостей предложено: 0</p>
    </div>

    <div class="col-md-8">
        @if($user->info->about)
        <div class="row">
            <div class="col-md-12">
                <p>О себе: {{ $user->info->about }}</p>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                @if($user->social->vkontakte)
                <p><a href="http://vk.com/{{ $user->social->vkontakte }}"><i class="fa fa-vk"></i>&nbsp;{{ trans('social.vkontakte') }}</a></p>
                @endif
                @if($user->social->facebook)
                <p><a href="http://facebook.com/{{ $user->social->facebook }}"><i class="fa fa-facebook"></i>&nbsp;{{ trans('social.facebook') }}</a></p>
                @endif
                @if($user->social->twitter)
                <p><a href="https://twitter.com/{{ $user->social->twitter }}"><i class="fa fa-twitter"></i>&nbsp;{{ trans('social.twitter') }}</a></p>
                @endif
                @if($user->social->github)
                <p><a href="https://github.com/{{ $user->social->github }}"><i class="fa fa-github"></i>&nbsp;{{ trans('social.github') }}</a></p>
                @endif
                @if($user->social->bitbucket)
                <p><a href="https://bitbucket.com/{{ $user->social->bitbucket }}"><i class="fa fa-bitbucket"></i>&nbsp;{{ trans('social.bitbucket') }}</a></p>
                @endif
                @if($user->social->google)
                <p><a href="https://plus.google.com/+{{ $user->social->google }}"><i class="fa fa-google-plus"></i>&nbsp;{{ trans('social.google') }}</a></p>
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
