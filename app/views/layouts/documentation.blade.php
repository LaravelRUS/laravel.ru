@extends('layouts.main')

@section('submenu')
<div id="submenu_panel">
<div class="navbar submenu-nav">
	<div class="container">
		<div class="row">
			@versionSelector($version, $name)
			<ul class="nav navbar-nav navbar-right">
				@if(allowEditTerms())
					@li('Термины', 'terms')
				@endif
				@li('Прогресс перевода', 'documentation.updates')
			</ul>
		</div>
	</div>
</div>
</div>
@stop

@section('container')
<div class="docs container">

	<div class="row">

		<div id="docs-sidebar" class="docs-sidebar col-md-3 col-sm-3 col-xs-12">
			<div class="box-invisible">
			@yield('sidebar')
			</div>
		</div><!--//docs-side-bar-->

		<div id="docs-entry" class="docs-entry section col-md-9 col-sm-9 col-xs-12">
			<div class="box">
				@yield('content')
			</div>
		</div> <!-- docs-entry -->

	</div> <!-- row -->
</div> <!-- container -->
@stop