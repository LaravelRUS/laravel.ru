@extends('layouts.left-sidebar')

@section('title', 'Новая статья')

@section('sidebar')

@stop

@section('contents')
<div class="col-xs-12 col-md-12">
	<main>
		<article class="bg-white p-35 border-rounded">
			<header>
				@if($isCreate)
					<h1>Новая статья</h1>
				@else
					<h1>Редактирование статьи</h1>
				@endif
			</header>
			<hr>
			@if( Session::has("success") )
				<div class="alert alert-success">
					{{ Session::get("success") }}
				</div>
			@endif

			{{ Form::open(['route' => 'articles.store']) }}
				{{ Element::hidden('id', $article->id) }}
				<div class="row">
					<div class="col-xs-12 col-sm-7">
						{{ Element::input('text', 'title', 'Название', null, $article->title, true) }}
					</div>
					<div class="col-xs-12 col-sm-5">
						{{ Element::input('text', 'slug', 'URL', null, $article->slug, true) }}
					</div>
				</div>
				{{ Element::textarea('description', 'Краткое описание', 5, null, $article->description) }}
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						{{ Element::select('version_id', 'Версия фреймворка', all_framework_versions(), $article->version_id, true) }}
					</div>
					<div class="col-xs-12 col-sm-6">
						{{ Element::select('difficulty_level_id', 'Уровень сложности', $difficultyLevels, $article->difficulty_level_id, true) }}
					</div>
				</div>
				<a id="fullScreen" href="#" class="btn fa fa-expand"><small data-text="[ESC]">[Ctrl+Enter]</small></a>
				{{ Element::ace('text', 'Текст статьи', $article->text) }}
				{{ Element::checkbox("is_draft", "Черновик", $article->is_draft) }}
				{{ Element::button('Сохранить') }}
			{{ Form::close() }}
		</article>
	</main>
</div>
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
@stop
