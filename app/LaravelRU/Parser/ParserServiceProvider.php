<?php namespace LaravelRU\Parser;

// TODO Это точно тот провайдер от корого необходимо наследоваться?
use Indatus\Dispatcher\ServiceProvider;

class ParserServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->singleton('LaravelRU\Parser\Parse');
	}

}
