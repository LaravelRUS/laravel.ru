<h4>Последние посты</h4>
@foreach ($articles as $article)
<span class="text-muted"><?= $article->displayDate() ?></span> <?= $article->author->displayProfileUrl() ?> -> <?= link_to_route("post.view", e($article->title), [$article->slug]) ?><br>
@endforeach