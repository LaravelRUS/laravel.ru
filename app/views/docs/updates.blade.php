@extends('_layout.rightsidebar')

@section('title')
    Апдейты документации
@stop

@section('content')

<h1>Апдейты документации</h1>

<?foreach($docs as $version=>$pages){?>

<h2><?= $version ?></h2>
<!--<table class="table table-bordered">-->
<!--    <tr>-->
<!--        <th rowspan="2"></th>-->
<!--        <th rowspan="2">Наименование</th>-->
<!--        <th rowspan="2">Перевод</th>-->
<!--        <th rowspan="2">Оригинал</th>-->
<!--        <th colspan="2">Разница</th>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <th>время</th>-->
<!--        <th>коммиты</th>-->
<!--    </tr>-->
<table class="table table-bordered">
    <tr>
        <th></th>
        <th>Наименование</th>
        <th>Перевод</th>
        <th>от оригинала</th>
        <th>Новые коммиты</th>
    </tr>
    <?foreach($pages as $i=>$page){?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $page->name ?></td>
        <td><?= $page->last_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_commit, 0, 7) ?></span></td>
        <td><?= $page->last_original_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_original_commit, 0, 7) ?></span></td>
        <td>
            <?if($page->original_commits_ahead==0){?>
                    <span class="text-success">0</span>
            <?}else{?>
                <span class="text-danger"><?= $page->original_commits_ahead ?></span> <a href="https://github.com/laravel/docs/commit/<?=$page->last_original_commit?>#diff-<?=$page->current_original_commit?>" target="_blank">diff</a>
            <?}?>
        </td>
    </tr>

    <?}?>
</table>

<?}?>

@stop