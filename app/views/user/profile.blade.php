@extends("_layout.rightsidebar")

@section("title")
    Пользователь <?= $user->name ?>
@stop

@section("content")

    <h1><?= e($user->name) ?></h1>


@stop