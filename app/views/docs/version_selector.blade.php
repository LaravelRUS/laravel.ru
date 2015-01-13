<ul class="nav navbar-nav version_selector_menu">
	<li>
		<span>Версия фреймворка:</span>
	</li>
	@foreach($all_versions as $version)
	<li class="{{ $version == $current_version ? 'active' : '' }}">
		<a href="{{ route('docs', [$version, $name]) }}">{{ $version }}</a>
	</li>
	@endforeach
</ul><!--//nav version selector -->
