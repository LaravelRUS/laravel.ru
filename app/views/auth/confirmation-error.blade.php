@extends('layouts.main')

@section('title', 'Ошибка при регистрации')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
				<main class="bg-white popup">
					<article>
						<aside class="header-icon danger">
							<i class="fa fa-times"></i>
						</aside>
						<header class="text-center">
							<h1 class="c-red">Код подтверждения неверен!</h1>
						</header>
						<hr>
						<p class="text-center">Указанный код неверный. Проверьте его ещё раз.</p>
					</article>
				</main>
			</div>
		</div>
	</div>
@stop