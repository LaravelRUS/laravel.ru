@extends("_layout/rightsidebar")

@section("title")
Блог <?= $user->name ?>
@stop

@section("content")

<h1>Блог <?= $user->name ?></h1>

<div class="well">Карма, статистика и прочие плюшки.</div>

<?foreach($posts as $post){?>

	@include("user/partials/short_blog_post")

<?}?>


@stop
