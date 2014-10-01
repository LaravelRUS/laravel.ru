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

<script>
	$(document).ready(function() {

	});

	function add_term(){
		var id = "new"+getRandomInt(111111, 999999);
		$(".add_term").before('<tr class="term_'+id+'">\
		<td style="width:50px;"><a href="#" class="btn btn-sm btn-danger" onclick="delete_term(\''+id+'\')"><span class="glyphicon glyphicon-remove"></span></a></td>\
		<td><input type="text" name="terms[]" value="" class="form-control" /></td>\
		</tr>');
	}

	function delete_term(id){
		$(".term_"+id).remove();
	}

	function getRandomInt(min, max)
	{
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

</script>

<?= Form::open(['url' => route("term.store"), 'method' => 'POST']) ?>

<?= Form::hidden("id", $termtext->id) ?>

<div class="form-group">
	<label>Термин и синонимы</label>
	<table class="table">
		<?if($termtext->id AND count($termtext->terms)>0){?>
			<?foreach($termtext->terms as $term){?>
				<tr class="term_<?=$term->id?>">
					<td style="width:50px;"><a href="#" class="btn btn-sm btn-danger" onclick="delete_term('<?=$term->id?>')"><span class="glyphicon glyphicon-remove"></span></a></td>
					<td><input type="text" name="terms[]" value="<?= $term->name ?>" class="form-control" /></td>
				</tr>
			<?}?>
		<?}?>
		<tr class="add_term">
			<td colspan="2"><a href="#" class="btn btn-default btn-sm" onclick="add_term()"><span class="glyphicon glyphicon-plus"></span></a></td>
		</tr>
	</table>
	<div class="text-muted">
		<small>Не забудь сохраниться после редактирования списка терминов.</small>
	</div>
	@include('field-error', ['field'=>'terms'])
</div>

<?= Form::textareaField("text", "Описание термина", "В описании поддерживается markdown.", $termtext->text) ?>

<div class="form-group">
	<input type="submit" class="btn btn-success" value="Сохранить">
</div>

<?= Form::close(); ?>
@stop