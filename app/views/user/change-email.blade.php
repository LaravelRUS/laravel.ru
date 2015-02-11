@extends('layouts.left-sidebar')

@section('title', 'Изменение Email адреса')

@section('sidebar')
	<div class="hidden-xs hidden-sm col-md-3 sidebar">
		@include('partials.widgets.profile', ['profile' => $user])
	</div>
@stop

@section('contents')
	<div class="col-xs-12 col-md-9">
		<section class="bg-white border-rounded p-35-45 m-b-30">
			<header>
				<h1>Изменение Email адреса</h1>
			</header>
			<hr>
			{{ Form::open(['route' => 'user.change-email', 'class' => 'ajax']) }}
			<section>
				<div class="row">
					<div class="col-xs-3"></div>
					<div class="col-xs-6">
						<div class="row">
							<div class="col-xs-12">
								{{ Element::input('email', 'email', 'Новый Email') }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								{{ Element::button('Изменить Email') }}
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
