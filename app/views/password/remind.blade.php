@extends('layouts.main')

@section('title', 'Сброс пароля')
@section('meta-description', 'Сброс пароля')

@section('container')
<div class="container">
	<section style="margin-bottom: 50px">
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6">
				<h1>Сброс пароля</h1>
				{{ Form::open(['class' => 'ajax reset']) }}
				<div class="row">
					<div class="col-xs-12">
						{{ Element::input('email', 'email', 'Ваш Email', 'Ваш Email', null, true) }}
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						{{ Element::button('Сбросить пароль') }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
			<div class="col-xs-3"></div>
		</div>
	</section>
</div>
@stop
