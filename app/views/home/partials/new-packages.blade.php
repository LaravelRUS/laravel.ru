<h3>Новые пакеты</h3>
<? foreach($newPackages as $package){ ?>
<div class="package_box">
	<div class="package_title">
		<span class="date"><?= $package->displayCreatedAt() ?></span><a href="<?= $package->repository ?>" target="_blank"><?= $package->name ?></a>
	</div>
	<div class="package_description">
		<?= $package->description ?>
	</div>
</div>
<?}?>