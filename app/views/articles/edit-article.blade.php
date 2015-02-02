@extends('layouts.nosidebar')

@section('title')
@if($article->id)
	Редактирование статьи
@else
	Создание статьи
@endif
@stop

@section('content')

{{--@include('layouts/partials/ace-editor')--}}

<script>
	$(function () {
		/* Вставляем tab при нажатии на tab в поле textarea
		 ---------------------------------------------------------------- */
		$('.article_text').keydown(function (event) {

			if (event.keyCode != 9) return;

			event.preventDefault();

			var obj = $(this)[0],
				start = obj.selectionStart,
				end = obj.selectionEnd,
				before = obj.value.substring(0, start),
				after = obj.value.substring(end, obj.value.length);

			obj.value = before + "\t" + after;

			obj.setSelectionRange(start+1, start+1);
		});
	});
</script>

{{ breadcrumbs(['Мой профайл' => route('user.profile', Auth::user()->username), '' => '']) }}
@if($article->id)
<h1>Редактирование поста</h1>
@else
<h1>Создание поста</h1>
@endif

@if(Session::has('success'))
	<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

{{ Form::open(['route' => 'article.store']) }}
	{{ Form::hidden('id', $article->id) }}
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label>Заголовок</label>
				{{ Form::text('title', $article->title, ['class' => 'form-control']) }}
				<div class="text-muted">Название статьи, выводится в списке статей</div>
				@include('field-error', ['field' => 'title'])
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Slug</label>
				{{ Form::text('slug', $article->slug, ['class' => 'form-control']) }}
				<div class="text-muted">URL по которому будет доступна эта статья</div>
				@include('field-error', ['field' => 'slug'])
			</div>
		</div>
	</div>

	<div class="form-group" id="input-description">
		<label>Краткое описание</label>
		{{ Form::textarea('description', $article->description, ['class' => 'form-control article_description']) }}
		<div class="text-muted">Краткое описание статьи, выводится на главной странице в списке статей</div>
		@include('field-error', ['field' => 'description'])
	</div>

	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Версия фреймворка</label>
				{{ Form::select('version_id', all_framework_versions(), $article->version_id, ['class'=>'form-control']) }}
				<div class="text-muted"></div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="form-group" id="input-difficulty">
				<label>Уровень сложности</label>
				{{ Form::select('difficulty', [
					'unknown' => 'Не определена',
					'easy' => 'Легкий, для новичков, слабо знакомых с фреймворком',
					'hard' => 'Сложный, для хорошо разбирающихся в фреймворке'
				], $article->difficulty, ['class' => 'form-control']) }}
				<div class="text-muted"></div>
				@include('field-error', ['field' => 'difficulty'])
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Текст</label>
		{{ Form::textarea('text', $article->text, ['class' => 'form-control article_text', 'id' => 'editor']) }}
		@include('field-error', ['field' => 'text'])
	</div>

	<div class="form-group">
		<label>{{ Form::check('is_translate', 1, $article->is_translate, ['class' => 'ios-switch']) }} Перевод</label>
		@include('field-error', ['field' => 'is_translate'])
	</div>

	<div class="form-group">
		<label>{{ Form::check('is_draft', 1, $article->is_draft, ['class' => 'ios-switch']) }} Черновик</label>
		<br><span class="text-muted">Черновики видны только вам</span>
		@include('field-error', ['field' => 'is_draft'])
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-default" value="Сохранить">
	</div>

{{ Form::close() }}
@stop
