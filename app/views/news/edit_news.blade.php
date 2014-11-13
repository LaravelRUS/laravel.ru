@extends('_layout.rightsidebar')

@section('title')
<?if($news->id){?>
    Редактирование новости
<?}else{?>
    Создание новости
<?}?>
@stop

@section('breadcrumbs')

@stop

@section('content')

<?if($news->id != 0){?>
    <?= breadcrumbs(['Главная'=>route("home"), 'Все новости'=>route("news"), "Редактирование"=>""]) ?>
    <h1>Редактирование новости</h1>
<?}else{?>
    <?= breadcrumbs(['Главная'=>route("home"), 'Все новости'=>route("news"), "Добавление"=>""]) ?>
    <h1>Создание новости</h1>
<?}?>

<? if(Session::has("success")){?>
    <div class="alert alert-success"><?= Session::get("success")  ?></div>
<?}?>

<?= Form::open(['url'=>route('news.store'), 'method'=>'POST', 'id'=>"formNews"]) ?>

<?= Form::hidden("id", $news->id) ?>

<?= Form::textareaField("text", "Текст новости", "Поддерживается markdown.", $news->text) ?>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="save" value="Сохранить">
</div>

<?= Form::close() ?>

@stop

