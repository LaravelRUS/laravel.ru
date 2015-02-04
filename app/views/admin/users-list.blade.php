@extends('layouts.left-sidebar')

@section('title', 'Список пользователей')
@section('meta-description', 'Описание')

@section('sidebar')
<div class="hidden-xs hidden-sm col-md-3 sidebar">
	@include('partials.widgets.profile', ['profile' => Auth::user()])
</div>
@stop

@section('contents')
<div class="col-xs-12 col-md-9">
	<main>
		<article class="bg-white p-35-45">
			<header>
				<h1 class="h2">Список пользователей</h1>
			</header>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">#</th>
						<th rowspan="2">Никнейм</th>
						<th class="hidden-xs" rowspan="2">Email</th>
						<th class="hidden-xs" colspan="{{ count($roles) }}">Права</th>
					</tr>
					<tr class="hidden-xs">
						@foreach($roles as $role)
							<th>{{ $role->name }}</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->username }}</td>
						<td class="hidden-xs">{{ $user->email }}</td>
						@foreach($roles as $role)
						<td class="hidden-xs text-center">
							@if($user->hasRole($role->name))
							{{ Form::open(['url'=>route("admin.remove_role")]) }}
								<input type="hidden" name="user_id" value="{{ $user->id }}">
								<input type="hidden" name="role_id" value="{{ $role->id }}">
								<button class="button success small" type="submit"><i class="fa fa-check"></i></button>
							{{ Form::close() }}
							@else
							{{ Form::open(['url'=>route("admin.add_role")]) }}
								<input type="hidden" name="user_id" value="{{ $user->id }}">
								<input type="hidden" name="role_id" value="{{ $role->id }}">
								<button class="button small" type="submit"><i class="fa fa-times"></i></button>
							{{ Form::close() }}
							@endif
						</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
		</article>
	</main>
</div>
@stop
