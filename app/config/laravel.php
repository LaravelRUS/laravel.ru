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


	'github_authenticate_token' => getenv("github_authenticate_token")

];
