<?php

return [

	'versions' => [
		'master',
		'4.2',
		'4.1',
	],

	'default_version' => '4.2',

	'original_docs' => [
		'user' => 'laravel',
		'repository' => 'docs'
	],

	'translated_docs' => [
		'user' => 'LaravelRUS',
		'repository' => 'docs'
	],

	'sleepingowl_admin_docs' => [
		'user' => 'sleeping-owl',
		'repository' => 'admin-docs'
	],


	'github_client_id' => getenv("github_client_id"),
	'github_client_secret' => getenv("github_client_secret")

];
