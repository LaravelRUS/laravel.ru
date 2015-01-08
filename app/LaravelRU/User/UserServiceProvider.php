<?php namespace LaravelRU\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

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
//		$viewPaths = \Config::get('view.paths');
//		$viewPaths[] = __DIR__.DIRECTORY_SEPARATOR.'Views';
//		\Config::set('view.paths', $viewPaths);

		// Including module-related routes etc
		include 'user_helpers.php';
		include 'user_events.php';
		include 'user_filters.php';

		$this->commands('LaravelRU\User\Commands\UserCommand');
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
