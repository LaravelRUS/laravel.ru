<?php namespace LaravelRU\Sidebar;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('sidebar', function ($app)
		{
			return $app->make('LaravelRU\Sidebar\Sidebar');
		});

		$this->app->booting(function ()
		{
			AliasLoader::getInstance()->alias('Sidebar', 'LaravelRU\Sidebar\Facades\Sidebar');
		});
	}

}
