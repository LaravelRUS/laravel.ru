@extends('layouts.main')

@section('submenu')
	<div class="subnav">
		<div class="container">
			<ul class="inline">
				<li class="docs-menu-button"><i class="fa fa-bars"></i></li>
				<li class="hidden-xs">
					<span>Версия фреймворка:</span>
				</li>
				@foreach($documentedVersions as $version)
					@if($version != "master")
					<li @if(Route::current()->parameter('version') == $version) class="active" @endif>
						<a href="{{ route('documentation', $version) }}">{{ $version }}</a>
					</li>
					@endif
				@endforeach
				<li class="float-right {{ activeClassName('documentation.status') }}">
					<a href="{{ route('documentation.status') }}">Прогресс перевода</a>
				</li>
			</ul>
		</div>
	</div>
@stop