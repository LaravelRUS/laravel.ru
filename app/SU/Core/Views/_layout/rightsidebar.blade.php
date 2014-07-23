@extends('_layout.main')

@section('container')

<div class="container">
	<div class="col-md-8">
		@yield('content')
	</div>
	<div class="row">
		<div class="col-md-4">
			@yield('sidebar')
		</div>
	</div>
</div>

@stop