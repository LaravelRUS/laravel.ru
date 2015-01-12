<section class="widget">
	<header class="m-b-25">
		<h3>Апдейты документации</h3>
	</header>
	<ul class="list-unstyled">
		@foreach($updatedDocs as $page)
			<li>
				<p class="title">
					<span class="date">{{ $page->displayUpdatedAt() }}</span>
					<span><a href="{{ route("docs", [$page->framework_version, $page->name]) }}">{{ $page->framework_version }}/{{ $page->name }}</a></span>
				</p>
				<p class="name">{{ $page->title }}</p>
			</li>
		@endforeach
	</ul>
</section>