<section class="widget">
	<header class="m-b-25 position-relative">
		<h3>Новые статьи</h3>
	</header>
	<ul class="unstyled">
		@foreach($lastArticles as $article)
			<li>
				<article>
					<header>
						<h4 class="m-b-0">
							<a href="{{ route("article.view", $article->slug) }}">{{ e($article->title) }}</a>
						</h4>
					</header>
					<div>
						<span class="date">{{ $article->present()->publishedAt }}</span>
						<span><a href="{{ route("user.profile", $article->author->username) }}">{{ $article->author->username }}</a></span>
						@if(allowEditArticle($article))
							<span class="m-l-10"><a class="btn btn-default btn-xs" href="{{ route("article.edit", [$article->slug]) }}"><i class="fa fa-fw fa-pencil"></i></a></span>
						@endif
					</div>
					<div class="article-preview">{{ e($article->description) }}</div>
				</article>
			</li>
		@endforeach
	</ul>
</section>