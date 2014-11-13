@extends('_layout.documentation')

@section('title')
<?= $page->displayTitle() ?>
@stop

@section('sidebar')

<?= $menu->displayText() ?>

@stop

@section('content')

<?if($page->original_commits_ahead > 0){?>
        <div class="well well-sm">
            <span class="text-danger">Эта страница устарела. Перевод от <?= $page->last_commit_at->format("d.m.Y") ?>, есть обновление от <?= $page->current_original_commit_at->format("d.m.Y") ?>.</span>
        </div>
<?}?>

<?= $page->displayText() ?>

@stop