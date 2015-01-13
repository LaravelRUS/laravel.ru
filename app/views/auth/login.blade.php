@extends('layouts.nosidebar')

@section('title')
Вход
@stop

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div style="margin: 150px 0 400px 0">
			<div class="box">
			<h1>Логин</h1>

			{{ Form::open(['route' => 'auth.login.post']) }}
				<div class="form-group">
					<label>Email</label>
					{{ Form::text('email', '', ['class' => 'form-control']); }}
					@include('field-error', ['field' => 'email'])
				</div>
				<div class="form-group">
					<label>Пароль</label>
					<input type="password" class="form-control" name="password">
					@include('field-error', ['field' => 'password'])
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="remember_me" value="1" {{ Input::old('remember_me') ? 'checked' : '' }}> запомнить меня</label><br>
					@include('field-error', ['field' => 'remember_me'])
				</div>
				<div class="form-group">
					<button class="btn btn-default">Войти</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@stop
