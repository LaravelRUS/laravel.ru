<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => false,

	'url' => 'http://laravel.su',

	'timezone' => 'Europe/Moscow',

	'providers' => append_config([
		'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
	])

);
