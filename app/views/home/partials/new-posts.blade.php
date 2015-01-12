<h3>Новые посты
	<?if(allowCreatePost()){?>
	<small>
		<a href="<?= route("post.create") ?>" class="btn btn-secondary btn-sm">Написать пост</a>
	</small>
	<?}?>
</h3>
<?foreach($lastPosts as $post){?>
<div class="post_box">
	<div class="post_title">
		<a href="<?= route("post.view", [$post->slug]) ?>"><?= e($post->title) ?></a></div>
	<div class="post_credentials">
		<span class="date"><?= $post->displayPublishedAt() ?></span> <?= $post->author->displayProfile() ?>
		<?if(allowEditPost($post)){?>
		<span class="controls"><a class="btn btn-default btn-xs" href="<?= route("post.edit", [$post->slug]) ?>">Редактировать</a></span>
		<?}?>
	</div>
	<div class="post_preview"><?= e($post->description) ?></div>
</div>
<?}?>