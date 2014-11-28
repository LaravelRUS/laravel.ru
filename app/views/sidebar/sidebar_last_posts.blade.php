<h4>Последние посты</h4>
@foreach ($posts as $post)
<span class="text-muted"><?= $post->displayDate() ?></span> <?= $post->author->displayProfileUrl() ?> -> <?= link_to_route("post.view", e($post->title), [$post->slug]) ?><br>
@endforeach