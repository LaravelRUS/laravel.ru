@extends('layouts.main')

@section('title', 'Пользователи сообщества')
@section('meta-description', 'Всем пользователи')

@section('container')
	<div class="container">
		<div class="row with-border">
			<section class="col-md-12">
				<h1>Пользователи</h1>

				<form action="" method="get" class="search-users">
					<input required name="query" type="text" class="form-control" placeholder="Поиск пользователя по имени" value="{{{ $query }}}">
			        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
				</form>

				<div class="text-center users-statuses">
					<strong>Группа:</strong>
					<a href="{{ route('users.group', 'administrators') }}">администраторы</a>
					<a href="{{ route('users.group', 'librarians') }}">библиотекари</a>
					<a href="{{ route('users.group', 'moderators') }}">модераторы</a>
				</div>

				<div class="text-center users-statuses">
					<strong>Показать:</strong>
					<a href="{{ route('users') }}">всех</a>
					<a href="{{ route('users', 'online') }}">кто сейчас на сайте</a>
					<a href="{{ route('users', 'offline') }}">кого нет</a>
				</div>

				@if( ! $users->isEmpty())
				<div class="text-center"  style="margin:40px 0"><strong>Показано {{ $users->count() }} из {{ $users->getTotal() }}</strong></div>

				<table class="users-list">
					<thead>
						<tr>
							<th style="text-align: center"></th>
							<th></th>
							<th style="text-align: center">Комментарии</th>
							<th style="text-align: center">Статьи</th>
						</tr>
					</thead>
					@foreach($users as $user)
					<tr>
						<td style="width:100px;vertical-align: top">
							<a href="{{ route('user.profile', $user->username) }}" style="border: none">
								<img class="users-list_avatar" width="100" src="{{ $user->avatar }}" alt="{{ $user->username }}" />
							</a>
						</td>
						<td style="vertical-align: top">
							<div class="users-list_info">
								<div class="username">
									<a href="{{ route('user.profile', $user->username) }}">{{ $user->present()->fullName }}</a>
									@if($user->isCurrentlyActive())
									<span class="user-online" title="Сейчас на сайте"></span>
									@endif
								</div>
								<div>Зарегистрировался: {{ $user->present()->created_at }}</div>
								@if( ! $user->isCurrentlyActive())
								<div>Последняя активность: {{ $user->present()->last_activity_at }}</div>
								@endif
								@if($user->info->birthday && $user->info->birthday->year > 0)
								<div>Родился: {{ $user->present()->birthday }}</div>
								@endif
							</div>
						</td>
						<td style="text-align: center">&mdash;</td>
						<td style="text-align: center">&mdash;</td>
					</tr>
					<tr><td colspan="4"><div class="space">&nbsp;</div></td></tr>
					@endforeach
				</table>
				{{ $users->appends('query', $query)->links('paginator.slider') }}
				@else
				<div class="text-center" style="margin:40px 0"><strong>Ничего не найдено</strong></div>
				@endif
			</section>
		</div>
	</div>
@stop
