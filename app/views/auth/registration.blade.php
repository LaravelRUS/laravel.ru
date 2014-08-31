@extends("..._layout.nosidebar")

@section("title")
	Регистрация
@stop

@section("content")
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Регистрация</h1>

			<?= Form::open(['route'=>'auth.registration.post']) ?>
				<div class="form-group">
					<label>Никнейм</label>
					<input type="text" class="form-control" name="name" value="<?= Input::old('name') ?>">
					@include('field-error', ['field'=>'name'])
				</div>
				<div class="form-group">
					<label>Пароль</label>
					<input type="password" class="form-control" name="password" value="<?= Input::old('password') ?>">
					@include('field-error', ['field'=>'password'])
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="<?= Input::old('email') ?>">
					@include('field-error', ['field'=>'email'])
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="i_agree" value="1"> Я соглашаюсь с правилами пользования.</label><br>
					@include('field-error', ['field'=>'i_agree'])
				</div>
				<div class="form-group">
					<button class="btn btn-success btn-lg btn-block">Зарегистрироваться</button>
				</div>
			</form>
		</div>
	</div>
@stop