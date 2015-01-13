<?php

function all_framework_versions()
{
	$allVersions = \Version::all();
	$options = [ 0 => 'любая / пост не относится к фреймворку'];
	foreach($allVersions as $version){
		$options[$version->id] = "Laravel $version->version";
	}
	return $options;
}