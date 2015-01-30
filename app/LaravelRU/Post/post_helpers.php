<?php

function all_framework_versions()
{
	$versions = LaravelRU\Core\Models\Version::all();
	$options = [0 => 'любая / статья не относится к фреймворку'];

	foreach ($versions as $version)
	{
		$options[$version->id] = "Laravel $version->number";
	}

	return $options;
}
