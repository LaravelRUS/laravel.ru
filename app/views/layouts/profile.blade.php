@extends('layouts.left-sidebar')

@section('title', $user->username)
@section('meta-description', 'Описание')

@section('sidebar')
	<main class="widget dark profile">
		@if($user->is_confirmed)
			<span class="verified"><i class="fa fa-check"></i></span>
		@endif
		@if(isOwner($user->username))
			<span class="settings" title="Настройки"><a href="{{ route('user.edit') }}"><i class="fa fa-cog"></i></a></span>
		@endif
		<img src="{{ $user->avatar }}" alt="{{ $user->name }}"/>
		<header class="text-center">
			<h1 class="h5">{{ $user->username }}</h1>
			{{--@if($user->isAdmin()) <span class="text-danger">Администратор</span> @endif--}}
			{{--@if($user->isModerator()) <span class="text-danger">Модератор</span> @endif--}}
		</header>
		<aside class="info">
			@if($user->info->name)
				<p class="text-center name">{{ $user->present()->fullname() }}</p>
			@endif
		</aside>
		<ul class="unstyled">
			<li>
				<p><i class="fa fa-file-o"></i> {{ $user->articles()->count() }}</p>
			</li>
			<li>
				<p title="Комментариев"><i class="fa fa-comments"></i> {{ $user->comments()->count() }}</p>
			</li>
		</ul>
		{{--@if($user->info->about)--}}
			{{--<li>--}}
				{{--<p title="О себе"><i class="fa fa-comments"></i> {{ $user->info->about }}</p>--}}
			{{--</li>--}}
		{{--@endif--}}
	</main>
	{{--<aside class="widget light versions">--}}
	{{--<header>--}}
	{{--<h4>Контакты</h4>--}}
	{{--</header>--}}
	{{--@if($user->social->vkontakte)--}}
	{{--<p><a href="https://vk.com/{{ $user->social->vkontakte }}"><i class="fa fa-vk"></i>&nbsp;{{ trans('social.vkontakte') }}</a></p>--}}
	{{--@endif--}}
	{{--@if($user->social->facebook)--}}
	{{--<p><a href="https://facebook.com/{{ $user->social->facebook }}"><i class="fa fa-facebook"></i>&nbsp;{{ trans('social.facebook') }}</a></p>--}}
	{{--@endif--}}
	{{--@if($user->social->twitter)--}}
	{{--<p><a href="https://twitter.com/{{ $user->social->twitter }}"><i class="fa fa-twitter"></i>&nbsp;{{ trans('social.twitter') }}</a></p>--}}
	{{--@endif--}}
	{{--@if($user->social->github)--}}
	{{--<p><a href="https://github.com/{{ $user->social->github }}"><i class="fa fa-github"></i>&nbsp;{{ trans('social.github') }}</a></p>--}}
	{{--@endif--}}
	{{--@if($user->social->bitbucket)--}}
	{{--<p><a href="https://bitbucket.com/{{ $user->social->bitbucket }}"><i class="fa fa-bitbucket"></i>&nbsp;{{ trans('social.bitbucket') }}</a></p>--}}
	{{--@endif--}}
	{{--@if($user->social->google)--}}
	{{--<p><a href="https://plus.google.com/+{{ $user->social->google }}"><i class="fa fa-google-plus"></i>&nbsp;{{ trans('social.google') }}</a></p>--}}
	{{--@endif--}}
	{{--</aside>--}}
@stop