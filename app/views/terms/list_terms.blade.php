@extends('_layout.nosidebar')

@section('title')
	Список терминов документации
@stop

@section('content')

<h1>Термины</h1>

<?if(allowEditTerms()){?>
	<a href="<?= route("term.create") ?>" class="btn btn-success">Создать</a>
<?}?>

<? if(count($termtexts)>0){ ?>

<? foreach($termtexts as $termtext){ ?>
<table class="table table-bordered">
	<tr>
		<td rowspan="<?= count($termtext->names) ?>">
			<ul class="list-group">
			<?foreach($termtext->names as $term){?>
				<li class="list-group-item"><?= $term->displayName() ?></li>
			<?}?>
			</ul>
		</td>
		<td>
			<?= $termtext->displayText() ?>
		</td>
	</tr>
</table>

<? } ?>


<? }else{ ?>
<p>Термины не определены.</p>
<?}?>
@stop