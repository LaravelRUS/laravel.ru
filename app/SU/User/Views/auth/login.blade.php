@extends("_layout.nosidebar")

@section("title")
Вход
@stop

@section("content")
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div style="margin: 100px 0 300px 0">
			<h1>Логин</h1>

			<form method="POST" action="<?= route("auth.login.post") ?>">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="<?= Input::old('email') ?>">
					@include('field-error', ['field'=>'email'])
				</div>
				<div class="form-group">
					<label>Пароль</label>
					<input type="password" class="form-control" name="password" value="<?= Input::old('password') ?>">
					@include('field-error', ['field'=>'password'])
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="remember_me" value="1"> запомнить меня</label><br>
					@include('field-error', ['field'=>'remember_me'])
				</div>
				<div class="form-group">
					<button class="btn btn-success btn-lg">Войти</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop