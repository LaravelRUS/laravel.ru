@extends('layouts.main')

@section('submenu')
	<div class="navbar submenu-nav">
		<div class="container">
			<ul class="list-inline">
				<li class="hidden-xs">
					<span>Версия фреймворка:</span>
				</li>
				@foreach($documentedVersions as $version)
					<li @if(Route::current()->parameter('version') == $version) class="active" @endif>
						<a href="{{ route('documentation', $version) }}">{{ $version }}</a>
					</li>
				@endforeach
				<li class="pull-right {{ activeClassName('documentation.status') }}">
					<a href="{{ route('documentation.status') }}">Прогресс перевода</a>
				</li>
			</ul>
		</div>
	</div>
@stop