@extends('_layout.nosidebar')

@section('title')
	Создание поста
@stop

@section('content')

<!--@include("_layout/partials/ace-editor")-->

<script>
	$(function(){

		/* Вставляем tab при нажатии на tab в поле textarea
		 ---------------------------------------------------------------- */
		$(".post_text").keydown(function(event){

			if( event.keyCode != 9 )
				return;

			event.preventDefault();

			var
					obj = $(this)[0],
					start = obj.selectionStart,
					end = obj.selectionEnd,
					before = obj.value.substring(0, start),
					after = obj.value.substring(end, obj.value.length);

			obj.value = before + "\t" + after;

			obj.setSelectionRange(start+1, start+1);
		});

	});
</script>

<?if($post->id){?>
	<?= breadcrumbs(['Главная'=>route("home"), 'Мой блог'=>route("user.blog", Auth::user()->name), ""=>""]) ?>
	<h1>Редактирование поста</h1>
<?}else{?>
	<?= breadcrumbs(['Главная'=>route("home"), 'Мой блог'=>route("user.blog", Auth::user()->name), ""=>""]) ?>
	<h1>Создание поста в блоге</h1>
<?}?>

<? if(Session::has("success")){?>
	<div class="alert alert-success"><?= Session::get("success")  ?></div>
<?}?>

<?= Form::open(['route'=>'post.store']) ?>

	<?= Form::hidden("id", $post->id) ?>

	<div class="form-group">
		<label>Заголовок</label>
		<?= Form::text("title", $post->title, ['class'=>'form-control']); ?>
		@include('field-error', ['field'=>'title'])
	</div>

	<div class="form-group">
		<label>Slug</label>
		<?= Form::text("slug", $post->slug, ['class'=>'form-control']); ?>
		<div class="text-muted">Строка в урле, с которой будет идентифицирован этот материал.</div>
		@include('field-error', ['field'=>'slug'])
	</div>

	<div class="form-group" id="input-description">
		<label>Описание</label>
		<?= Form::textarea("description", $post->description, ['class'=>'form-control post_description']) ?>
		<div class="text-muted">Краткое описание, выводится в списке постов.</div>
		@include('field-error', ['field'=>'description'])
	</div>

	<div class="form-group" id="input-difficulty">
		<label>Уровень сложности материала</label>
		<?= Form::select("difficulty", ['unknown'=>"Не определять", 'easy'=>'Легкий, для новичков, слабо знакомых с фреймворком', 'hard'=>"Сложный, для хорошо разбирающихся в фреймворке"], $post->difficulty, ['class'=>'form-control']); ?>
		<div class="text-muted">Для фильтра по сложности контента - чтобы новички могли подбирать для себя подходящие обучающие материалы.</div>
		@include('field-error', ['field'=>'difficulty'])
	</div>

	<div class="form-group">
		<label>Парсер</label>
		<?= Form::select("parser_type", ['markdown'=>'Markdown', 'uversewiki'=>'Uversewiki'], $post->parset_type, ['class'=>'form-control']); ?>
		<span class="text-muted">Формат текста поста.</span>
		@include('field-error', ['field'=>'parser_type'])
	</div>

	<div class="form-group">
		<label>Текст</label>
		<?= Form::textarea("text", $post->text, ['class'=>'form-control post_text', 'id'=>'editor']) ?>
		@include('field-error', ['field'=>'text'])
	</div>

	<div class="form-group">
		<label><?= Form::check("is_draft", 1, $post->is_draft,['class'=>'ios-switch']); ?> Черновик</label>
		<br><span class="text-muted">Черновики видны только вам.</span>
		@include('field-error', ['field'=>'is_draft'])
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-default" value="Сохранить">
	</div>

<?= Form::close() ?>

<!--@include("_layout/partials/ace-editor")-->

@stop