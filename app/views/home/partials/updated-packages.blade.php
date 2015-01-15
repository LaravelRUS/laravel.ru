<section class="widget">
	<header class="m-b-25">
		<h3>Обновлённые пакеты</h3>
	</header>
	<ul class="list-unstyled">
		@foreach($updatedPackages as $package)
			<li>
				<p class="title">
					<span class="date">{{ $package->created_at->format('d M') }}</span>
					<span><a href="{{ URL::to($package->repository) }}" target="_blank">{{ $package->name }}</a></span>
				</p>
				<p>{{ $package->description }}</p>
			</li>
		@endforeach
	</ul>
</section>