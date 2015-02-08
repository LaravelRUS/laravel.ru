@extends('layouts.admin')

@section('title', 'Запрещённые слова')

@section('container')
	<main class="container m-b-30">
		<article class="bg-white p-35-45">
			<header>
				<h1 class="h2">Запрещённые слова</h1>
			</header>
			<hr>
			<a href="{{ route('admin.restricted-words.create') }}" class="button success m-b-25">Добавить слово</a>
			<table class="data-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>Actions</th>
					</tr>
				</thead>
			</table>
		</article>
	</main>
@stop

@section('scripts')
	<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
@stop
