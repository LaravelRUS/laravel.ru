@extends('layouts.documentation')

@section('title', e($page->title))
@section('meta-description', 'Описание')

@section('sidebar')
	{{ $menu ? $menu->displayText() : '' }}
@stop

@section('content')
	<div class="box">
		@if($page->original_commits_ahead > 0)
		<div class="well well-sm">
			<span class="text-danger">Эта страница устарела. Перевод от {{ $page->last_commit_at->format('d.m.Y') }}, есть обновление от {{ $page->current_original_commit_at->format('d.m.Y') }}.</span>
		</div>
		@endif

		{{ $page->displayText() }}
	</div>
@stop
