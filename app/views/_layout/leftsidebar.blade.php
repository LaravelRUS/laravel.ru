@extends('_layout.main')

@section('container')

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="box-invisible">
				@yield('sidebar')
			</div>
		</div>
		<div class="col-md-9">
			<div class="box">
				@yield('content')
			</div>
		</div>
	</div>
</div>

@stop