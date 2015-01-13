<?php namespace LaravelRU\Parser;

use Illuminate\Support\ServiceProvider;

class ParserServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->singleton('LaravelRU\Parser\Parse');
	}

}
