@extends('_layout.documentation')

@section('title')
<?= $page->displayTitle() ?>
@stop

@section('sidebar')

<?= $menu->displayText() ?>

@stop

@section('content')

<?= $page->displayText() ?>

@stop