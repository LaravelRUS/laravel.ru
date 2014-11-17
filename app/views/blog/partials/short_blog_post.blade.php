<div class="post_short">
	<a href="<?= route("post.view", [$article->slug]) ?>" class="post_short_link">
		<?= e($article->title) ?>
	</a><br>
	<span class="text-muted">Автор: <?= $user->displayProfileUrl() ?>. </span>
	<div class="post_short_description">
		<?= e($article->description) ?>
	</div>
</div>