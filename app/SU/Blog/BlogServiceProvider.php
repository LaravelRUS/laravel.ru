<?php namespace SU\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

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

		// Add folder Views in global views path. Use subfolder 'blog' for place module views.
        $viewPaths = \Config::get('view.paths');
        $viewPaths[] = __DIR__.DIRECTORY_SEPARATOR.'Views';
        \Config::set('view.paths', $viewPaths);

		// Register Artisan command (if needed)
		// $this->commands('SU\Blog\Commands\BlogCommand');

		// Including module-related routes etc
		include __DIR__.DIRECTORY_SEPARATOR.'blog_routes.php';
		include __DIR__.DIRECTORY_SEPARATOR.'blog_helpers.php';
		include __DIR__.DIRECTORY_SEPARATOR.'blog_events.php';
		include __DIR__.DIRECTORY_SEPARATOR.'blog_filters.php';

		// ...
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
