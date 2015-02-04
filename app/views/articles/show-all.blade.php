@extends('layouts.left-sidebar')

@section('title', 'Статьи')
@section('meta-description', 'Описание')

@section('sidebar')
<div class="col-xs-12 col-sm-4 col-md-3 sidebar">
	<aside class="widget light categories">
		<header>
			<h4>Категории</h4>
		</header>
		<ul class="unstyled">
			<li>Путешествия</li>
			<li>Туризм</li>
		</ul>
	</aside>
	<aside class="widget light versions">
		<header>
			<h4>Версии</h4>
		</header>
		<ul class="inline">
			<li>4.2</li>
			<li>5.0</li>
		</ul>
	</aside>
</div>
@stop

@section('contents')
<div class="col-xs-12 col-sm-8 col-md-9">
	<main class="articles">
		@if(count($articles))
			<ul class="unstyled">
				@foreach($articles as $article)
					<li>1</li>
				@endforeach
			</ul>
		@else
			<p class="bg-white p-35-45">Пока нет ни одной статьи :(</p>
		@endif
	</main>
</div>
@stop