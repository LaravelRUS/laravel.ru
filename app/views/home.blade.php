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
					<?if(allowCreatePost()){?>
						<small><a href="<?= route("post.create") ?>" class="btn btn-secondary btn-sm">Написать свою</a></small>
					<?}?>
				</h3>
				<?foreach($lastPosts as $post){?>
					@previewPost($post)
				<?}?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3>Новое в документации</h3>
				In a professional context it often happens that private or corporate clients corder a publication to be made and presented with the actual content still not being ready. Think of a news blog that's filled with content hourly on the day of going live. However, reviewers tend to be distracted by comprehensible content, say, a random text copied from a newspaper or the internet. The are likely to focus on the text, disregarding the layout and its elements. Besides, random text risks to be unintendedly humorous or offensive, an unacceptable risk in corporate environments. Lorem ipsum and its many variants have been employed since the early 1960ies, and quite likely since the sixteenth century.
			</div>
			<div class="col-md-4">
				<h3>Вопросы</h3>
				In a professional context it often happens that private or corporate clients corder a publication to be made and presented with the actual content still not being ready. Think of a news blog that's filled with content hourly on the day of going live. However, reviewers tend to be distracted by comprehensible content, say, a random text copied from a newspaper or the internet. The are likely to focus on the text, disregarding the layout and its elements. Besides, random text risks to be unintendedly humorous or offensive, an unacceptable risk in corporate environments. Lorem ipsum and its many variants have been employed since the early 1960ies, and quite likely since the sixteenth century.
			</div>
			<div class="col-md-4">
				<h3>Кое-что совершенно другое</h3>
				In a professional context it often happens that private or corporate clients corder a publication to be made and presented with the actual content still not being ready. Think of a news blog that's filled with content hourly on the day of going live. However, reviewers tend to be distracted by comprehensible content, say, a random text copied from a newspaper or the internet. The are likely to focus on the text, disregarding the layout and its elements. Besides, random text risks to be unintendedly humorous or offensive, an unacceptable risk in corporate environments. Lorem ipsum and its many variants have been employed since the early 1960ies, and quite likely since the sixteenth century.
			</div>
		</div>




	</div> <!-- row -->
</div> <!-- container -->
</div>

@stop