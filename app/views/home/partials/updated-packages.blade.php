<h3>Обновлённые пакеты</h3>
<? foreach($updatedPackages as $package){ ?>
<div class="package_box">
	<div class="package_title">
		<a href="<?= $package->repository ?>" target="_blank"><?= $package->name ?></a>
		<span class="date">(<?= $package->displayUpdatedAt() ?>)</div>
	<div class="package_description">
		<?= $package->description ?>
	</div>
</div>
<?}?>