@extends('layouts.documentation_sleepingowl_admin')

@section('title', e($page->title))
@section('meta-description', 'Описание')

@section('container')
	<main class="container docs no-gutter-xs">
		<div class="row">
			<div class="col-xs-12 col-md-3 sidebar normal-padding">
				<section>{{ $menu->displayText() }}</section>
			</div>
			<div class="col-xs-12 col-md-9 main m-b-30">
				<article class="bg-white p-35-45 status-green">
					{{ $page->displayText() }}
				</article>
			</div>
		</div>
	</main>
@stop