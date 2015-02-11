<?php $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator) ?>

<div class="text-center" style="margin-bottom: 40px">
	<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="pagination">
		<?= $presenter->getPrevious('&larr; Назад') ?>
		<?= $presenter->getPageRange(1, $paginator->getLastPage()) ?>
		<?= $presenter->getNext('Вперед &rarr;') ?>
	</ul>
	<?php endif ?>
</div>
