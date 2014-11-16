<?php namespace LaravelRU\Article;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider {

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
		// Add folder Views in global views path. Use subfolder 'post' for place module views.
//        $viewPaths = \Config::get('view.paths');
//        $viewPaths[] = __DIR__ . '/Views';
//        \Config::set('view.paths', $viewPaths);

		// Register Artisan command (if needed)
		//$this->commands('LaravelRU\Article\Commands\PostCommand');

		// Including module-related routes etc
		include __DIR__.DIRECTORY_SEPARATOR.'article_widgets.php';

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
