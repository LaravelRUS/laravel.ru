@extends('layouts.main')

@section('container')
	<main class="container">
		<div class="row">
			<div class="col-xs-3 sidebar">
				@yield('sidebar')
			</div>
			<div class="col-xs-9">
				@yield('contents')
			</div>
		</div>
	</main>
@stop