@extends('layouts.left-sidebar')

@section('title', 'Изменение пароля')

@section('sidebar')
	<div class="hidden-xs hidden-sm col-md-3 sidebar">
		@include('partials.widgets.profile', ['profile' => $user])
	</div>
@stop

@section('contents')
	<div class="col-xs-12 col-md-9">
		<section class="bg-white border-rounded p-35-45 m-b-30">
			<header>
				<h1>Изменение пароля</h1>
			</header>
			<hr>
			{{ Form::open(['route' => 'user.change-password', 'class' => 'ajax']) }}
			<section>
				<div class="row">
					<div class="col-xs-3"></div>
					<div class="col-xs-6">
						<div class="row">
							<div class="col-xs-12">
								{{ Element::input('password', 'password_old', 'Старый пароль') }}
							</div>
							<div class="col-xs-12">
								{{ Element::input('password', 'password_new', 'Новый пароль') }}
							</div>
							<div class="col-xs-12">
								{{ Element::input('password', 'password_new_confirmation', 'Подтверждение пароля') }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								{{ Element::button('Изменить пароль') }}
							</div>
						</div>
					</div>
					<div class="col-xs-3"></div>
				</div>
			</section>
			{{ Form::close() }}
		</section>
	</div>
@stop
