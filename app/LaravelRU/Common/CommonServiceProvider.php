<?php namespace LaravelRU\Common;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class CommonServiceProvider extends ServiceProvider {

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
		// Add folder Views in global views path. Use subfolder 'user' for place module views.
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__.DIRECTORY_SEPARATOR.'Views';
		\Config::set('view.paths', $viewPaths);

		include __DIR__.DIRECTORY_SEPARATOR."common_helpers.php";
		include __DIR__.DIRECTORY_SEPARATOR."common_widgets.php";
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		include __DIR__.DIRECTORY_SEPARATOR.'common_macro.php';
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


