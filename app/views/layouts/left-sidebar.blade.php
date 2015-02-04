@extends('layouts.main')

@section('container')
	<main class="container">
		<div class="row">
			<div class="col-xs-12 sidebar">
				@yield('sidebar')
			</div>
			<div class="col-xs-12 col-sm-9">
				@yield('contents')
			</div>
		</div>
	</main>
@stop