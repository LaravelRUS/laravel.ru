{{-- // TODO refactor this --}}
<div class="box_news">
<<<<<<< HEAD
    <div class="date">
        <?= $news->created_at ?>
        <?if(allowEditNews($news->id)){?>
        <span class="">
            <a href="<?= route("news.edit", [$news->id]) ?>" class="btn btn-default btn-xs">Редактировать</a>
        </span>
        <?}?>
    </div>
    <p><?= $news->text ?></p>
=======
	<div class="date">
		{{ $news->displayDate() }}
		@if(allowEditNews($news->id))
			<span class="m-l-10">
	            <a href="{{ route("news.edit", $news->id) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-pencil"></i></a>
	        </span>
		@endif
	</div>
	<p>{{ $news->displayText() }}</p>
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
</div>