@extends('layouts.admin')

@section('title', 'Новое слово')

@section('container')
	<main class="container m-b-30">
		<article class="bg-white p-35-45">
			<header>
				<h1 class="h2">Новое слово</h1>
			</header>
			<hr>
			{{ Form::open(['route' => 'admin.restricted-words.store', 'class' => 'ajax']) }}
				{{ Element::input('text', 'title', 'Название', null, null, true) }}
				{{ Element::button('Добавить') }}
			{{ Form::close() }}
		</article>
	</main>
@stop