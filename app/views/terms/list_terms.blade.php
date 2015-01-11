@extends('layouts.nosidebar')

@section('title')
	Список терминов документации
@stop

@section('content')

<h1>Термины</h1>

<?if(allowEditTerms()){?>
	<a href="<?= route("term.create") ?>" class="btn btn-success">Создать</a><br><br>
<?}?>

<? if(count($termtexts)>0){ ?>

<? foreach($termtexts as $termtext){ ?>
<table class="table table-bordered">
	<tr>
		<td rowspan="<?= count($termtext->terms) ?>" style="width: 200px;">
			<h5>Термины <small><a href="<?= route("term.edit",[$termtext->id]) ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></small></h5>
			<ul>
			<?foreach($termtext->terms as $term){?>
				<li><?= $term->displayName() ?></li>
			<?}?>
			</ul>
		</td>
		<td>
			<h5>Описание</h5>
			<?= $termtext->displayText() ?>
		</td>
	</tr>
</table>

<? } ?>


<? }else{ ?>
<p>Термины не определены.</p>
<?}?>
@stop