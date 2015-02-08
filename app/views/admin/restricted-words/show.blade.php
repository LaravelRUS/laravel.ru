@extends('layouts.admin')

@section('title', $word->title)

@section('container')
	<main class="container m-b-30">
		<article class="bg-white p-35-45">
			<header>
				<h1 class="h2">{{ $word->title }}</h1>
			</header>
			<hr>
			{{ Element::input('text', 'title', 'Название', null, $word->title, true, true) }}
			<a href="{{ route('admin.restricted-words.index') }}" class="button">Назад</a>
		</article>
	</main>
@stop