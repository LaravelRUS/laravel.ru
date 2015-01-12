{{-- // TODO refactor this --}}
<div class="box_news">
	<div class="date">
		{{ $news->displayDate() }}
		@if(allowEditNews($news->id))
			<span class="m-l-10">
	            <a href="{{ route("news.edit", $news->id) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-pencil"></i></a>
	        </span>
		@endif
	</div>
	<p>{{ $news->displayText() }}</p>
</div>