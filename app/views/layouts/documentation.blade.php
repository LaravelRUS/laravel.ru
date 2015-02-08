@extends('layouts.main')

@section('submenu')
	<div class="subnav">
		<div class="container">
			<ul class="inline">
				@if(Route::currentRouteName() == 'documentation')
					<li class="docs-menu-button"><i class="fa fa-bars"></i></li>
				@endif
				<li class="hidden-xs hidden-sm">
					<span>Версия фреймворка:</span>
				</li>
				@foreach($documentedVersions as $version)
					@if($version != "master")
					<li @if(Route::current()->parameter('version') == $version) class="active" @endif>
						<a href="{{ route('documentation', $version) }}">{{ $version }}</a>
					</li>
					@endif
				@endforeach
				<li class="float-right docs-status {{ activeClassName('documentation.status') }}">
					<a href="{{ route('documentation.status') }}"><i class="fa fa-book"></i><span class="hidden-xs">Прогресс перевода</span></a>
				</li>
			</ul>
		</div>
	</div>
@stop