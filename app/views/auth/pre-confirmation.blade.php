@extends('layouts.main')

@section('title', 'Завершение регистрации')
@section('meta-description', 'Описание')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<main class="bg-white p-45 popup">
					<article>
						<div class="header-icon success">
							<i class="fa fa-check"></i>
						</div>
						<header class="text-center">
							<h1 class="c-green">Регистрация прошла успешно!</h1>
						</header>
						<p class="text-center">Ссылка для завершения регистрации выслана на email.</p>
					</article>
				</main>
			</div>
		</div>
	</div>
@stop