@extends('layouts.main')

@section('title', 'Завершение регистрации')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
				<main class="bg-white popup">
					<article>
						<aside class="header-icon success">
							<i class="fa fa-check"></i>
						</aside>
						<header class="text-center">
							<h1 class="c-green">Регистрация прошла успешно!</h1>
						</header>
						<hr>
						<p class="text-center">Ссылка для завершения регистрации выслана на email.</p>
					</article>
				</main>
			</div>
		</div>
	</div>
@stop