@extends('main')

@section('container')

<div class="container">
	<div class="col-md-8">
		@yield('content')
	</div>
	<div class="row">
		<div class="col-md-4">
			<h1>Сайдбар</h1>
			<div class="well">Виджет</div>
			@yield('sidebar')
		</div>
	</div>
</div>

@stop