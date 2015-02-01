@extends('layouts.profile')

@section('title', $user->username)
@section('meta-description', 'Описание')

@section('contents')
	<section>
			<ul class="tabs">
				<li class="active" data-tab="articles">
					<p>Статьи</p>
				</li>
				<li data-tab="news">
					<p>Новости</p>
				</li>
				<li data-tab="drafts">
					<p>Черновики</p>
				</li>
			</ul>
			<ul class="tab-contents">
				<li class="visible" data-tab="articles">
					<section>
						@if(count($user->articles))
							<ul class="unstyled">
								@foreach($user->articles as $article)
									<li>{{ 1 }}</li>
								@endforeach
							</ul>
						@else
							<p>Пользователь пока не написал ни одной статьи</p>
						@endif
					</section>
				</li>
				<li data-tab="news">
					<section>
						<p>123</p>
					</section>
				</li>
				<li data-tab="drafts">
					<section>
						<p>dr</p>
					</section>
				</li>
			</ul>
	</section>
@stop