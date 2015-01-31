<?php namespace LaravelRU\Articles;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		// Including module-related routes etc
		include __DIR__ . DIRECTORY_SEPARATOR . 'post_helpers.php';
	}

}
