<section class="widget">
	<header class="m-b-25 position-relative">
		<h3>Новости</h3>
		@if(allowCreateNews())
			<a href="{{ route("news.create") }}" class="btn btn-secondary btn-sm btn-corner"><i class="fa fa-fw fa-plus"></i></a>
		@endif
	</header>
	<ul class="unstyled">
		@foreach($lastNews as $news)
			@news($news)
			{{-- // TODO Нужно ли так писать виджеты, а не через include? --}}
		@endforeach
	</ul>
</section>