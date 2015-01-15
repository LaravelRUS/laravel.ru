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
						<a href="{{ route('docs', $version) }}">{{ $version }}</a>
					</li>
				@endforeach
				<li class="pull-right">
					<a href="{{ route('documentation.updates') }}">Прогресс перевода</a>
				</li>
			</ul>
		</div>
	</div>
@stop

@section('container')
	<div class="container docs">
		<div class="row">
			<div class="col-xs-12 col-md-3 hidden-xs hidden-sm sidebar">
				@yield('sidebar')
			</div>
			<div class="col-xs-12 col-md-9 main m-b-30">
				@yield('content')
			</div>
		</div>
	</div>
@stop