@extends("_layout.promohome")

@section("title")
Laravel - русскоязычное комьюнити
@stop

@section("content")



<div class="masthead homepage hexagons">
	<div class="container">
		<h1>Laravel - php-фреймворк нового поколения</h1>
		<p class="button-subtext">Мы верим, что процесс разработки только тогда наиболее продуктивен, когда работа с фреймворком приносит радость и удовольствие. Счастливые разработчики пишут лучший код.</p>
		<a class="btn btn-default">Быстрый старт</a> <button class="btn btn-default">Документация</button>
	</div>
</div>


<div class="super-container-white">
<div class="container">
	<div class="row">

		<div class="row">
			<div class="col-md-6" style="border-right: 1px solid #eee;">
				<h3>Новости
					<?if(allowCreateNews()){?>
					<small><a href="<?= route("news.create") ?>" class="btn btn-secondary btn-sm">Предложить новость</a></small>
					<?}?>
				</h3>
				<?foreach($lastNews as $news){?>
					@news($news)
				<?}?>

			</div>
			<div class="col-md-6">
				<h3>Новые статьи
					<?if(allowCreateArticle()){?>
						<small><a href="<?= route("article.create") ?>" class="btn btn-secondary btn-sm">Написать свою</a></small>
					<?}?>
				</h3>
				<?foreach($lastArticles as $article){?>
					<div class="article_box">
						<div class="article_title"><a href="<?= route("article.view", [$article->slug]) ?>"><?= e($article->title) ?></a></div>
						<div class="article_credentials"><span class="date"><?= $article->displayPublishedAt() ?></span> <?= $article->author->displayProfile() ?></div>
						<div class="article_preview"><?= e($article->description) ?></div>
					</div>
				<?}?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-4" style="border-right: 1px solid #eee;">

				<h3>Новые пакеты</h3>
				<? foreach($newPackages as $package){ ?>
					<div class="package_box">
						<div class="package_title"><span class="date"><?= $package->displayCreatedAt() ?></span><a href="<?= $package->repository ?>" target="_blank"><?= $package->name ?></a></div>
						<div class="package_description">
							<?= $package->description ?>
						</div>
					</div>
				<?}?>
			</div>

			<div class="col-md-4" style="border-right: 1px solid #eee;">

				<h3>Обновлённые пакеты</h3>
				<? foreach($updatedPackages as $package){ ?>
					<div class="package_box">
						<div class="package_title"><a href="<?= $package->repository ?>" target="_blank"><?= $package->name ?></a> <span class="date">(<?= $package->displayUpdatedAt() ?>)</div>
						<div class="package_description">
							<?= $package->description ?>
						</div>
					</div>
				<?}?>
			</div>

			<div class="col-md-4">
				<h3>Апдейты документации</h3>
				<? foreach($updatedDocs as $page){ ?>
					<div class="docs_box">
						<div class="title"><span class="date"><?= $page->displayUpdatedAt() ?></span> <a href="<?= route("docs", [$page->framework_version, $page->name]) ?>"><?=$page->framework_version?>/<?=$page->name?></a></div>
						<div class="name"><?= $page->title ?></div>

					</div>
				<?}?>

			</div>
		</div>




	</div> <!-- row -->
</div> <!-- container -->
</div>

@stop