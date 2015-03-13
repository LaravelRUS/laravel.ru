<section class="widget">
	<header class="m-b-25 position-relative">
		<h3>Новые статьи</h3>
	</header>
	<ul class="unstyled">
		@foreach($lastArticles as $article)
			<li>
				<article>
					@include("articles/box", compact("article"))
				</article>
			</li>
		@endforeach
	</ul>
</section>