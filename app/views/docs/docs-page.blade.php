@extends('layouts.documentation')

@section('title', e($page->title))
@section('meta-description', 'Описание')

@section('sidebar')
	<section>{{ Markdown::render($menu->text) }}</section>
@stop

@section('content')
	<div class="bg-white p-35-45 {{ translationStatus($page) }}">
		{{ $page->present()->documentText() }}
	</div>
@stop
