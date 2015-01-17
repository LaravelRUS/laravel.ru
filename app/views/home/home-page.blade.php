@extends('layouts.main')

@section('title', 'Laravel - русскоязычное комьюнити')
@section('meta-description', 'Описание')

@section('container')
	<div class="homepage hexagons text-center">
		<div class="container">
			<h1 class="c-white letter-spacing-stiff">Laravel &mdash; php-фреймворк нового поколения</h1>
			<h2 class="c-white small m-b-25">Мы верим, что процесс разработки только тогда наиболее продуктивен, когда работа с фреймворком приносит радость и удовольствие. Счастливые разработчики пишут лучший код.</h2>
			<ul class="list-inline">
				<li>
					<a class="btn btn-default" href="{{ route('documentation') }}">Документация</a>
				</li>
				<li>
					<a class="btn btn-default" href="{{ route('cheat-sheet') }}">Cheat Sheet</a>
				</li>
				<li>
					<a class="btn btn-default" href="#">Циклы обучающих статей</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="bg-white p-20-0">
		<div class="container">
			<div class="row with-border">
				<section class="col-md-8">
					@include('home.partials.new-posts')
				</section>
				<section class="col-md-4">
					@include('home.partials.news')
				</section>
			</div>
			<hr>
			<div class="row with-border">
				<section class="col-md-4">
					@include('home.partials.new-packages')
				</section>
				<section class="col-md-4 border-right">
					@include('home.partials.updated-packages')
				</section>
				<section class="col-md-4">
					@include('home.partials.docs-updates')
				</section>
			</div>
		</div>
	</div>
@stop
