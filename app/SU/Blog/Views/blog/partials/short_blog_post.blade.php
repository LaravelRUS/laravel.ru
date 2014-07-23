<div class="short_post">
	<a href="<?= route("post.view", [$post->slug]) ?>" >
		<?= e($post->title) ?>
	</a><br>
	<span class="text-muted">Автор: <?= $user->present()->name ?>. </span>
</div>