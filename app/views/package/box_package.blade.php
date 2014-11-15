<div class="box_package">
    <div class="package_title"><span class="package_date"><?= $package->displayCreatedAt() ?></span><a href="<?= $package->repository ?>" target="_blank"><?= $package->name ?></a></div>
    <div class="package_description">
        <?= $package->description ?>
    </div>
</div>