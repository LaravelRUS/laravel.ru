<header>
	<h4 class="m-b-0">
		<a href="{{ route("articles.show", $article->slug) }}">{{ e($article->title) }}</a>
	</h4>
</header>
<div>
	<span class="date">{{ $article->present()->publishedAt }}</span>
	<span><a href="{{ route("user.profile", $article->author->username) }}">{{ $article->author->username }}</a></span>
	@if(allowEditArticle($article))
		<span class="controls"><a class="btn btn-default btn-xs" href="{{ route('articles.edit', $article->id) }}">Редактировать</a></span>
	@endif
</div>
<div class="article-preview">{{ e($article->description) }}</div>