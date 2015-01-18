<?php namespace LaravelRU\HTML;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind('bootstrap3', 'LaravelRU\HTML\Bootstrap3');

		$this->app->booting(function ()
		{
			AliasLoader::getInstance()->alias('Bootstrap3', 'LaravelRU\HTML\Facades\Bootstrap3');
		});
	}

}
