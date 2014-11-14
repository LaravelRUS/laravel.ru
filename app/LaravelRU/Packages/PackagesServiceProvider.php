<?php namespace LaravelRU\Packages;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PackagesServiceProvider extends ServiceProvider {

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
		// Register Artisan command (if needed)
		$this->commands('LaravelRU\Packages\Commands\RefillPackagesCommand');

		// Including module-related routes etc
		//include __DIR__.DIRECTORY_SEPARATOR.'packages_helpers.php';

/*
		// Registering facade
		$this->app->bind('packagesfacade', function($app){
	        return new \LaravelRU\Packages\Facades\PackagesFacadeClass();
	    });
	    // Registering alias for facade
	    $this->app->booting(function(){
	        AliasLoader::getInstance()->alias('Packages', 'LaravelRU\Packages\Facades\Packages');
	    });
*/
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
