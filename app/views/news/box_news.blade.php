<div class="box_news">
    <div class="date">
        <?= $news->displayDate() ?>
        <?if(allowEditNews($news->id)){?>
        <span class="">
            <a href="<?= route("news.edit", [$news->id]) ?>" class="btn btn-default btn-xs">Редактировать</a>
        </span>
        <?}?>
    </div>
    <p><?= $news->displayText() ?></p>
</div>