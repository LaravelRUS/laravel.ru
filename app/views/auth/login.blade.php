@extends('layouts.nosidebar')

@section('title')
Вход
@stop

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div style="margin:150px 0 400px">
			<div class="box">
			<h1>Авторизация</h1>

			{{ Form::open(['route' => 'auth.login.post']) }}
				<div class="form-group">
					<label>Логин / Email</label>
					{{ Form::text('login', '', ['class' => 'form-control', 'required' => 'required']) }}
					@include('field-error', ['field' => 'login'])
				</div>

				<div class="form-group">
					<label>Пароль</label>
					<input type="password" class="form-control" name="password" required="required">
					@include('field-error', ['field' => 'password'])
				</div>

				<div class="form-group">
					<button class="btn btn-default">Войти</button>
					@include('field-error', ['field' => 'wrong_input'])
				</div>
			{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop
