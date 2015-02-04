<section class="widget">
	<header class="m-b-25">
		<h3>Новые пакеты</h3>
	</header>
	<ul class="unstyled">
		@foreach($newPackages as $package)
			<li>
				<p class="title">
					<span class="date">{{ $package->present()->creationDate() }}</span>
					<span><a href="{{ URL::to($package->repository) }}" target="_blank">{{ $package->name }}</a></span>
				</p>
				<p>{{ $package->description }}</p>
			</li>
		@endforeach
	</ul>
</section>