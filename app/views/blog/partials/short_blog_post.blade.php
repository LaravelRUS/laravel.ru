<div class="post_short">
	<a href="<?= route("post.view", [$post->slug]) ?>" class="post_short_link">
		<?= e($post->title) ?>
	</a><br>
	<span class="text-muted">Автор: <?= $user->displayProfileUrl() ?>. </span>
	<div class="post_short_description">
		<?= e($post->description) ?>
	</div>
</div>