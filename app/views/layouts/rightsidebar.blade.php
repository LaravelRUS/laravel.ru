@extends('layouts.main')

@section('container')

<div class="container">
	<div class="col-md-8">

		@yield('breadcrumbs')

		<div class="box">
			@yield('content')
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="box-invisible sidebar">
				@yield('sidebar')
<!--				Sidebar::renderLastPosts()-->
			</div>
		</div>
	</div>
</div>

@stop