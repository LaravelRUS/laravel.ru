@extends('_layout.nosidebar')

@section('title')
	<?= e($post->title) ?>
@stop

@section('content')

<h1><?= e($post->title) ?></h1>

<div class="post_credentials">
	Автор: <?= $post->author->displayProfile() ?>
</div>

<?if(allowEditPost($post->id)){?>
	<div class="user_controls">
		<a href="<?= route('post.edit',[$post->slug]) ?>" class="btn btn-default btn-sm">Редактировать</a>
	</div>
<?}?>


<div class="post_content">
	<?= $post->displayText() ?>
</div>

@stop