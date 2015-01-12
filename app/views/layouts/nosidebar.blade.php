@extends('layouts.main')

@section('container')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				@yield('content')
			</div>
		</div>
	</div>
</div>

@stop