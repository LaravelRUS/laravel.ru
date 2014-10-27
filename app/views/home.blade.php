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

		<div class="section col-md-12 col-sm-12 col-xs-12">


		<h3>Приветствие</h3>
		<p>Lorem ipsum dolor sit amet, dicit iriure at vel, inani eruditi no mel. Pri ex mazim placerat assueverit, ad quodsi everti erroribus vix, mundi delicatissimi sit ex. Fugit tantas atomorum vix et. Quo omnes vidisse ad, ad sed dicam consectetuer, cum senserit voluptatum ne. Eos ea sint magna, vis summo dicit sadipscing ut.

			Tantas omnium singulis ea vel, postea consetetur honestatis eos eu. Doctus fabulas appellantur at sit, his vero accommodare et, graeco vocent ex nam. Meis dolorem an sed, vim ex inimicus consequat. Nam assum erroribus et, amet veniam invidunt est cu. Consul everti volutpat te vis, vel ea invenire voluptaria. Ne posse electram usu, nusquam gubergren id has.

			Prima periculis mel no. Mei ex doming vivendo. Ei per ancillae lucilius expetenda, mea tempor meliore nominati no. Te altera bonorum persequeris pri, dicunt consequuntur has et. At est brute eruditi erroribus.</p>

		<div class="row">
			<div class="col-md-6">
				<h3>Новости</h3>
				<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
			</div>
			<div class="col-md-6">
				<h3>Новые статьи</h3>
				<?= $last_posts ?>
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


		</div> <!-- blog-entry -->

	</div> <!-- row -->
</div> <!-- container -->
</div>

@stop