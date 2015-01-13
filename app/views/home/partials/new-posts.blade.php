<section class="widget">
	<header class="m-b-25 position-relative">
		<h3>Новые посты</h3>
		@if(allowCreatePost())
			<a href="{{ route("post.create") }}" class="btn btn-secondary btn-sm btn-corner"><i class="fa fa-fw fa-plus"></i></a>
		@endif
	</header>
	<ul class="list-unstyled">
		@foreach($lastPosts as $post)
			<li>
				<article>
					<header>
						<h4 class="m-b-0"><a href="{{ route("post.view", $post->slug) }}">{{ e($post->title) }}</a></h4>
					</header>
					<div>
						<span class="date">{{ $post->displayPublishedAt() }}</span>
						<span><a href="{{ route("user.profile", $post->author->name) }}">{{ $post->author->name }}</a></span>
						@if(allowEditPost($post))
							<span class="m-l-10"><a class="btn btn-default btn-xs" href="{{ route("post.edit", [$post->slug]) }}"><i class="fa fa-fw fa-pencil"></i></a></span>
						@endif
					</div>
					<div class="post-preview">{{ e($post->description) }}</div>
				</article>
			</li>
		@endforeach
	</ul>
</section>