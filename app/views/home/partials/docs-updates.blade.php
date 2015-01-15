<section class="widget">
	<header class="m-b-25">
		<h3>Апдейты документации</h3>
	</header>
	<ul class="list-unstyled">
		@foreach($updatedDocs as $doc)
			<li>
				<p class="title">
					<span class="date">{{ $doc->present()->lastCommitDate() }}</span>
					<span><a href="{{ route('docs', [$doc->frameworkVersion->number, $doc->page]) }}">{{ $doc->frameworkVersion->number }}/{{ $doc->page }}</a></span>
				</p>
				<p class="name">{{ $doc->title }}</p>
			</li>
		@endforeach
	</ul>
</section>
