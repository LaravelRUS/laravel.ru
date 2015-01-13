{{-- // TODO refactor this --}}
<div class="box_news">
    <div class="date">
        <?= $news->created_at ?>
        <?if(allowEditNews($news->id)){?>
        <span class="">
            <a href="<?= route("news.edit", [$news->id]) ?>" class="btn btn-default btn-xs">Редактировать</a>
        </span>
        <?}?>
    </div>
    <p><?= $news->text ?></p>
</div>