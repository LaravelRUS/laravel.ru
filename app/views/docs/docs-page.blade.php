@extends('layouts.documentation')

@section('title', e($page->title))
@section('meta-description', 'Описание')

@section('container')
	<main class="container docs">
		<div class="row">
			<div class="col-xs-12 col-md-3 sidebar">
				<section>{{ Markdown::render($menu->text) }}</section>
			</div>
			<div class="col-xs-12 col-md-9 main m-b-30">
				<article class="bg-white p-35-45 {{ translationStatus($page) }}">
					{{ $page->present()->documentText() }}
				</article>
			</div>
		</div>
	</main>
@stop