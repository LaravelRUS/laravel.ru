@extends('_layout.nosidebar')

@section('title')
	<?= e($article->title) ?>
@stop

@section('content')

<h1><?= e($article->title) ?></h1>

<div class="post_credentials">
	Автор: <?= $article->author->displayProfile() ?>
</div>

<?if(allowEditArticle($article->id)){?>
	<div class="user_controls">
		<a href="<?= route('article.edit',[$article->slug]) ?>" class="btn btn-default btn-sm">Редактировать</a>
	</div>
<?}?>


<div class="post_content">
	<?= $article->displayText() ?>
</div>

@stop