@extends('_layout.nosidebar')

@section('title')
    Апдейты документации
@stop

@section("submenu")

<div class="navbar submenu-nav">

    <div class="container">
        <div class="row">
            <ul class="nav navbar-nav navbar-right">
                <?if(allowEditTerms()){?><li class="<?= activeByRoute("terms") ?>"><a href="<?= route("terms") ?>">Термины</a></li><?}?>
                @li("Прогресс перевода", "documentation.updates")
            </ul>
        </div>
    </div>
</div>

@stop

@section('content')

<h1>Апдейты документации</h1>

<p>Если вы хотите помочь с переводом документации, ознакомьтесь пожалуйста с этой <a href="/content/rus-documentation-contribution-guide">инструкцией</a>.</p>

<?foreach($docs as $version=>$pages){?>

<h2>Ветка <?= $version ?></h2>
<table class="table table-bordered">
    <tr>
        <th></th>
        <th>Наименование</th>
        <th>Перевод</th>
        <th>от оригинала</th>
        <th>Текущий оригинал</th>
        <th>Новые коммиты</th>
    </tr>
    <?foreach($pages as $i=>$page){?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $page->name ?></td>
        <td><?= $page->last_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_commit, 0, 7) ?></span></td>
        <td><?= $page->last_original_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_original_commit, 0, 7) ?></span></td>
        <td><span class="text-muted">

                <a href="https://github.com/laravel/docs/blob/<?=$page->current_original_commit?>/<?= $page->name ?>.md"><?=$page->current_original_commit?></a>
            </span>
        </td>
        <td>
            <?if($page->original_commits_ahead==0){?>
                    <span class="text-success">перевод не требуется</span>
            <?}else{?>
                <span class="text-danger"><?= $page->original_commits_ahead ?></span>
                git difftool <?=substr($page->last_original_commit, 0, 7)?> <?=substr($page->current_original_commit, 0, 7)?> <?= $page->name ?>.md
            <?}?>
        </td>
    </tr>

    <?}?>
</table>

<?}?>

@stop