@extends('..._layout.leftsidebar')

@section('title')
<?= $title ?>
@stop

@section('sidebar')

<div class="sidebar">
<?= $sidebar ?>
</div>

@stop

@section('content')

<div class="docs">
<?= $html ?>
</div>

@stop