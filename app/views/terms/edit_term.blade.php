@extends('_layout.rightsidebar')

@section('title')
	Редактирование термина
@stop

@section('content')

<?if($termtext->id){?>
	<h1>Редактирование термина</h1>
<?}else{?>
	<h1>Создание термина</h1>
<?}?>

<?= Form::open(['url' => route("term.store"), 'method' => 'POST']) ?>

<div class="form-group">
	<label>Термин и синонимы</label>
	<input type="text" class="form-control" name="xyzname" value="{{ Input::old('xyzname') }}">
	@include('field-error', ['field'=>'xyzname'])
	<div class="text-muted">
		<small>xyz_help_text</small>
	</div>
</div>

<table class="table">
<?if(count($termtext->terms)>0){?>

	<?foreach($termtext->terms as $term){?>
	<tr>
		<td><button class="btn btn-xs btn-danger">Удалить</button></td>
		<td><?= $term->displayName() ?></td>
	</tr>
	<?}?>
<?}?>
</table>

<?= Form::textareaField("text", "Описание термина", "Поддерживается markdown", $termtext->text) ?>

<?= Form::close(); ?>
@stop