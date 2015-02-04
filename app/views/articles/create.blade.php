@extends('layouts.left-sidebar')

@section('title', 'Новая статья')

@section('sidebar')
<div class="hidden-xs hidden-sm col-md-3 sidebar">
	@include('partials.widgets.profile', ['profile' => Auth::user()])
</div>
@stop

@section('contents')
<div class="col-xs-12 col-md-9">
	<main>
		<article class="bg-white p-35 border-rounded">
			<header>
				<h1>Новая статья</h1>
			</header>
			<hr>
			{{ Form::open(['route' => 'articles.store']) }}
				{{ Element::hidden('id', $article->id) }}
				<div class="row">
					<div class="col-xs-12 col-sm-7">
						{{ Element::input('text', 'title', 'Название', null, null, true) }}
					</div>
					<div class="col-xs-12 col-sm-5">
						{{ Element::input('text', 'slug', 'URL', null, null, true) }}
					</div>
				</div>
				{{ Element::input('text', 'meta_description', 'Описание для поисковиков', null, null, true) }}
				{{ Element::textarea('description', 'Краткое описание', 5, null, null) }}
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						{{ Element::select('version_id', 'Версия фреймворка', all_framework_versions(), null, true) }}
					</div>
					<div class="col-xs-12 col-sm-6">
						{{ Element::select('difficulty_level_id', 'Уровень сложности', $difficultyLevels, null, true) }}
					</div>
				</div>
				{{ Element::ace('text', 'Текст статьи') }}
				<input type="checkbox" name="is_draft" checked>
				{{ Element::button('Сохранить') }}
			{{ Form::close() }}
		</article>
	</main>
</div>
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
@stop