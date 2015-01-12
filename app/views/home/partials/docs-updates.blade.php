<h3>Апдейты документации</h3>
<? foreach($updatedDocs as $page){ ?>
<div class="docs_box">
	<div class="title"><span class="date"><?= $page->displayUpdatedAt() ?></span>
		<a href="<?= route("docs", [$page->framework_version, $page->name]) ?>"><?=$page->framework_version?>/<?=$page->name?></a>
	</div>
	<div class="name"><?= $page->title ?></div>

</div>
<?}?>