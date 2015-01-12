<h3>Новости
	<?if(allowCreateNews()){?>
	<small>
		<a href="<?= route("news.create") ?>" class="btn btn-secondary btn-sm">Предложить новость</a>
	</small>
	<?}?>
</h3>
<?foreach($lastNews as $news){?>
@news($news)
<?}?>