<?php

function all_framework_versions()
{
	$versions = LaravelRU\Core\Models\Version::all();

	foreach ($versions as $version)
	{
		$options[$version->id] = "Laravel $version->number";
	}

	return $options;
}
