@extends('layouts.admin')

@section('title', $restrictedWord->title)

@section('container')
	<div class="col-xs-12">
		<main>
			<article class="bg-white p-35-45">
				<header>
					<h1 class="h2">{{ $restrictedWord->title }}</h1>
				</header>
				<hr>

			</article>
		</main>
	</div>
@stop