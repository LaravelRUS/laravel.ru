@extends('layouts.rightsidebar')

@section('title')
    "Знаете ли вы, что?"
@stop

@section('breadcrumbs')

@stop

@section('content')

<?if($tip->id != 0){?>
    <?= breadcrumbs(['Мои советы'=>route("user.tips"), "Редактирование"=>""]) ?>
    <h1>Редактирование новости</h1>
<?}else{?>
    <?= breadcrumbs(['Мои советы'=>route("user.tips"), "Добавление"=>""]) ?>
    <h1>Создание новости</h1>
<?}?>

<? if(Session::has("success")){?>
    <div class="alert alert-success"><?= Session::get("success")  ?></div>
<?}?>

<?= Form::open(['url'=>route('tip.store'), 'method'=>'POST', 'id'=>"formNews"]) ?>

<?= Form::hidden("id", $tip->id) ?>

<?= Form::textareaField("text", "Текст", " Поддерживается markdown.", $tip->text) ?>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="save" value="Сохранить">
</div>

<?= Form::close() ?>

@stop

