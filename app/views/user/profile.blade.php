@extends('layouts.left-sidebar')

@section('title', $user->username)
@section('meta-description', 'Описание')

@section('sidebar')
<div class="col-xs-12 col-sm-4 col-md-3 sidebar">
	@include('partials.widgets.profile', ['profile' => $user])
</div>
@stop

@section('contents')
<div class="col-xs-12 col-sm-8 col-md-9">
	<section class="bg-white p-35 p-b-25 m-b-30 border-rounded">

		@if($user->info->birthday && $user->info->birthday->year > 0)
			<p class="m-b-5"><strong>Родился</strong></p>
			<p class="small" title="Родился">{{ $user->present()->birthday }}</p>
		@endif
		@if($user->info->about)
			<p class="m-b-5"><strong>Краткая информация</strong></p>
			<p class="small" title="О себе">{{ $user->info->about }}</p>
		@endif
		@if($user->info->about || $user->info->birthday)
			<hr>
		@endif
		<aside class="row">
			<section class="col-xs-6 col-sm-3">
				<p class="text-center big"><strong>{{ $user->articles()->count() }}</strong></p>
				<p class="tiny text-center text-uppercase last">Статей</p>
			</section>
			<section class="col-xs-6 col-sm-3">
				<p class="text-center big"><strong>{{ $user->comments()->count() }}</strong></p>
				<p class="tiny text-center text-uppercase last">Комментариев</p>
			</section>
		</aside>
	</section>
	<section>
		<ul class="tabs">
			<li class="active" data-tab="articles">
				<p>Статьи</p>
			</li>
			<li data-tab="news">
				<p>Новости</p>
			</li>
			@if(isOwner($user->username) || isAdmin())
			<li data-tab="drafts">
				<p>Черновики</p>
			</li>
			@endif
		</ul>
		<ul class="tab-contents">
			<li class="visible" data-tab="articles">
				<section>
					@if($user->articles->count())
						<ul class="unstyled">
							@foreach($user->articles as $article)
								<li>{{ $article->title }}</li>
							@endforeach
						</ul>
					@else
						<p>Пользователь пока не написал ни одной статьи</p>
					@endif
				</section>
			</li>
			<li data-tab="news">
				<section>
					<div>
						<div>Новость 1</div>
						<div>Новость 2</div>
					</div>
				</section>
			</li>
			@if(isOwner($user->username) || isAdmin())
			<li data-tab="drafts">
				<section>
					<div>
						<div>Черновик 1</div>
						<div>Черновик 2</div>
					</div>
				</section>
			</li>
			@endif
		</ul>
	</section>
</div>
@stop
