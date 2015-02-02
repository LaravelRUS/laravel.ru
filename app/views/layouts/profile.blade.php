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
		</header>
		<aside class="info">
			@if($user->info->name)
				<p class="text-center">{{ $user->present()->fullname() }}</p>
			@endif
			<aside class="badges text-center">
				@if($user->isAdmin())
					<span class="badge badge-admin" title="Администратор"><i class="fa fa-diamond"></i></span>
				@endif
				@if($user->isModerator())
					<span class="badge badge-moderator" title="Модератор"><i class="fa fa-gavel"></i></span>
				@endif
				@if($user->isLibrarian())
					<span class="badge badge-librarian" title="Библиотекарь"><i class="fa fa-institution"></i></span>
				@endif
			</aside>
		</aside>
	</main>
@stop