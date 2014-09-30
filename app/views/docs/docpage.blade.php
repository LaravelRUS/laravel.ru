@extends('..._layout.leftsidebar')

@section('title')
<?= $page->displayTitle() ?>
@stop

@section('sidebar')

<div class="sidebar">
<?= $menu->displayText() ?>
</div>

@stop

@section('content')

<div class="docs">
<?= $page->displayText() ?>
</div>

@stop