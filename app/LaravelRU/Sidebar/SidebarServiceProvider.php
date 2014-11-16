<?php namespace LaravelRU\Sidebar;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use LaravelRU\Article\Repositories\PostRepo;

class SidebarServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind("sidebar", function($app){
			return $app->make('LaravelRU\Sidebar\Sidebar');
		});
		$this->app->booting(function(){
			AliasLoader::getInstance()->alias('Sidebar', 'LaravelRU\Sidebar\Facades\Sidebar');
		});

	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
