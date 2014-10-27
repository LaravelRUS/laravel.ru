@extends('_layout.main')

@section('container')


<div class="docs container">


	<div class="row">

		<div id="docs-sidebar" class="docs-sidebar col-md-3 col-sm-3 col-xs-12">
			@yield('sidebar')
		</div><!--//blog-side-bar-->

		<div id="docs-entry" class="docs-entry section col-md-9 col-sm-9 col-xs-12">

			@yield('content')

		</div> <!-- blog-entry -->

	</div> <!-- row -->
</div> <!-- container -->


@stop