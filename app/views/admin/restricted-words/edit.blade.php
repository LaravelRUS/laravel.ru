@extends('layouts.admin')

@section('title', $word->title)

@section('container')
	<main class="container m-b-30">
		<article class="bg-white p-35-45">
			<header>
				<h1 class="h2">{{ $word->title }}</h1>
			</header>
			<hr>
			{{ Form::open(['route' => ['admin.restricted-words.update', $word->id], 'method' => 'put', 'class' => 'ajax']) }}
				{{ Element::input('text', 'title', 'Название', null, $word->title, true) }}
				{{ Element::button('Добавить') }}
			{{ Form::close() }}
		</article>
	</main>
@stop