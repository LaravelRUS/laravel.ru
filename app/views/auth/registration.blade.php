@extends('layouts.nosidebar')

@section('title')
Регистрация
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div style="margin: 50px 0 400px 0">
				<div class="box">
					<h1>Регистрация</h1>

					{{ Form::open(['route' => 'auth.registration.post']) }}

						<div class="form-group">
							<label>Никнейм</label>
							<input type="text" class="form-control" name="name" value="{{ Input::old('name') }}">
							{{ Form::hidden('js_token'); }}
							@include('field-error', ['field' => 'name'])
						</div>
						<div class="form-group">
							<label>Пароль</label>
							<input type="password" class="form-control" name="password" value="">
							@include('field-error', ['field' => 'password'])
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" name="email" value="{{ Input::old('email') }}">
							@include('field-error', ['field' => 'email'])
						</div>
						{{--<div class="form-group">--}}
							{{--{{ Form::captcha() }}--}}
							{{--@include('field-error', ['field'=>'g-recaptcha-response'])--}}
						{{--</div>--}}
						<div class="form-group">
							<button class="btn btn-primary">Зарегистрироваться</button>
						</div>
						<div>Регистрируясь на сайте вы автоматически соглашаетесь с действующими здесь
							<a href="/help/rules">правилами</a>.</div>
						@include('field-error', ['field' => 'js_token'])
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
<script>
$(document).ready(function() {
	$('input[name=name] + input').val('{{ $jsToken }}')
});
</script>
@stop
