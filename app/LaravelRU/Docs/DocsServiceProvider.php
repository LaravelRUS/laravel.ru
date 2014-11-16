<?php namespace LaravelRU\Docs;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use LaravelRU\Docs\Commands\UpdateDocsCommand;
use LaravelRU\Docs\Widgets\DocsWidget;

class DocsServiceProvider extends ServiceProvider{

	public function register()
	{
		$this->commands('LaravelRU\Docs\Commands\UpdateDocsCron');

		include __DIR__.DIRECTORY_SEPARATOR.'docs_widgets.php';

		// Регистрация фасада DocsWidget
//		$this->app->bind("docswidget", function($app){
//			return new DocsWidget();
//		});
//		$this->app->booting(function(){
//			AliasLoader::getInstance()->alias('DocsWidget', 'LaravelRU\Docs\Facades\DocsWidget');
//		});
	}

	public function boot()
	{

	}

}