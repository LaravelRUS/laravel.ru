<?php namespace LaravelRU\Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		// Including module-related routes etc
		include __DIR__ . DIRECTORY_SEPARATOR . 'post_widgets.php';
		include __DIR__ . DIRECTORY_SEPARATOR . 'post_helpers.php';
	}

}
