@extends('layouts.main')

@section('title', 'Ошибка при регистрации')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<main class="bg-white p-45 popup">
					<article>
						<aside class="header-icon danger">
							<i class="fa fa-times"></i>
						</aside>
						<header class="text-center">
							<h1 class="c-red">Код подтверждения неверен!</h1>
						</header>
						<p class="text-center">Указанный код неверный. Проверьте его ещё раз.</p>
					</article>
				</main>
			</div>
		</div>
	</div>
@stop