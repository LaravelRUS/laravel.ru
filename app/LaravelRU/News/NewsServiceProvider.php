<?php namespace LaravelRU\News;

use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		include __DIR__ . DIRECTORY_SEPARATOR . 'news_widgets.php';
	}

	public function boot()
	{

	}
}