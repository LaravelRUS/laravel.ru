@extends('layouts.main')

@section('container')
	<main class="container">
		<div class="row">
			@yield('sidebar')
			@yield('contents')
		</div>
	</main>
@stop