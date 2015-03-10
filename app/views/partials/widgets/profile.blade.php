<section class="widget dark profile">
	@if($profile->is_confirmed)
		<span class="verified"><i class="fa fa-check"></i></span>
	@endif
	@if(isOwner($profile->username))
		<span class="settings" title="Настройки"><a href="{{ route('user.edit') }}"><i class="fa fa-cog"></i></a></span>
	@endif
	<div class="avatar">
		<img src="{{ $profile->avatar }}" alt="{{ $profile->name }}"/>
		@if(isOwner($profile->username))
			<div class="changeAvatar">
				<i class="fa fa-upload"></i>
				<div class="js-fileapi-wrapper">
					<input type="file" name="avatar" />
				</div>
			</div>
			<a href="#" class="deleteAvatar{{ ! $profile->info->avatar ? ' hidden' : '' }}"><i class="fa fa-remove"></i> Удалить фото</a>
		@endif
	</div>
	<header class="text-center">
		<h1 class="h5">{{ $profile->username }}</h1>
		@if($profile->info->name)
			<p class="text-center">{{ $profile->present()->fullname }}</p>
		@endif
	</header>
	<aside class="badges text-center">
		@if($profile->isAdmin())
			<span class="badge badge-admin" title="Администратор"><i class="fa fa-diamond"></i></span>
		@endif
		@if($profile->isModerator())
			<span class="badge badge-moderator" title="Модератор"><i class="fa fa-gavel"></i></span>
		@endif
		@if($profile->isLibrarian())
			<span class="badge badge-librarian" title="Библиотекарь"><i class="fa fa-institution"></i></span>
		@endif

		<div style="margin-top: 20px;">
		@if( ! $profile->isCurrentlyActive())
			<p class="m-b-5"><strong>Последний раз был на сайте</strong></p>
			<p class="small" title="Активность">{{ $profile->present()->last_activity_at }}</p>
		@else
			<p class="small" title="Статус"><span class="user-online user-online_inline"></span> Сейчас на сайте</p>
		@endif
		</div>
	</aside>

</section>


@if(isOwner($profile->username))

	<section class="widget dark profile">
		<ul class="unstyled">
			<li><a href="{{ route('articles.create') }}">Новая статья</a></li>
			<li><a href="{{ route('articles.create') }}">Черновики</a></li>
		</ul>
	</section>

@endif