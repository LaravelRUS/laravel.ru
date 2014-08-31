@foreach ($posts as $post)
<span class="text-muted"><?= $post->present()->date ?></span> <?= $post->author->present()->blog ?> -> <?= link_to_route("post.view", e($post->title), [$post->slug]) ?><br>
@endforeach