@extends('_layout.nosidebar')

@section('title')
	Список терминов документации
@stop

@section('content')

<? if(count($terms)>0){ ?>

<? foreach($terms as $term){ ?>
<table class="table table-bordered">
<tr>
<td rowspan="<?= count($term->names) ?>">
    
</td>
<td>

</td>
</tr>
</table>


<? } ?>


<? }else{ ?>
<p>Термины не определены.</p>
<?}?>
@stop