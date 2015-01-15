<ul class="list-inline">
	<li class="hidden-xs">
		<span>Версия фреймворка:</span>
	</li>
	@foreach($all_versions as $version)
		<li class="{{ $version == $current_version ? 'active' : '' }}">
			<a href="{{ route('docs', [$version, $name]) }}">{{ $version }}</a>
		</li>
	@endforeach
	<li class="pull-right">
		<a href="{{ route('documentation.updates') }}">Прогресс перевода</a>
	</li>
</ul>