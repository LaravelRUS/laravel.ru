<?php namespace LaravelRU\Access;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider {

	public function register()
	{
		include __DIR__ . '/access_helpers.php';

		$this->app->bind('access', function ()
		{
			return new Access();
		});

		$this->app->booting(function ()
		{
			AliasLoader::getInstance()->alias('Access', 'LaravelRU\Access\Facades\Access');
		});
	}

}
