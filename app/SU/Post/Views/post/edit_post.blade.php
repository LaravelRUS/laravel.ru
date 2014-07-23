@extends('_layout/rightsidebar')

@section('title')
	Создание поста
@stop

@section('content')

<?if($post->id){?>
	<h1>Редактирование поста</h1>
<?}else{?>
	<h1>Создание поста в блоге</h1>
<?}?>

<?= Form::open(['route'=>'post.store']) ?>
<?= Form::token() ?>

	<?= Form::hidden("id", $post->id) ?>

	<div class="form-group">
		<label>Заголовок</label>
<!--		<input type="text" class="form-control" name="title" value="--><?//= Input::old('title') ?><!--">-->
		<?= Form::text("title", $post->title, ['class'=>'form-control']); ?>
		@include('field-error', ['field'=>'title'])
	</div>

	<div class="form-group">
		<label>Slug</label>
		<?= Form::text("slug", $post->slug, ['class'=>'form-control']); ?>
		<span class="text-muted">Строка в урле, с которо будет идентифицирован этот материал.</span>
		@include('field-error', ['field'=>'slug'])
	</div>

	<div class="form-group">
		<label>Парсер</label>
		<?= Form::select("parser_type", ['markdown'=>'Markdown', 'uversewiki'=>'Uversewiki'], $post->parset_type, ['class'=>'form-control']); ?>
		<span class="text-muted">Формат текста поста.</span>
		@include('field-error', ['field'=>'slug'])
	</div>

	<div class="form-group">
		<label>Текст</label>
		<?= Form::textarea("text", $post->text, ['class'=>'form-control']) ?>
		@include('field-error', ['field'=>'text'])
	</div>

	<div class="form-group">
		<?= Form::checkbox("is_draft", 1, $post->is_draft); ?> <label>Черновик</label>
		<br><span class="text-muted">Черновики видны только вам.</span>
		@include('field-error', ['field'=>'is_draft'])
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-default" value="Сохранить">
	</div>

<?= Form::close() ?>

@stop