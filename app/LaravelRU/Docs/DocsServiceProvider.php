<?php namespace LaravelRU\Docs;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use LaravelRU\Docs\Commands\UpdateDocsCommand;

class DocsServiceProvider extends ServiceProvider{

	public function register()
	{
		// Module routes
		require __DIR__.DIRECTORY_SEPARATOR.'docs_routes.php';

		// Module views
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/Views';
		\Config::set('view.paths', $viewPaths);

		$this->commands('LaravelRU\Docs\Commands\UpdateDocsCommand');

	}

	public function boot()
	{
		// Artisan
		//Artisan::add(new UpdateDocsCommand);
		//$artisan = $this->app->make("artisan");
		//$artisan->add(new UpdateDocsCommand);

//		$this->app->bind("commands.su.update_docs", function($app){
//			new UpdateDocsCommand;
//		});
	}

	public function provides()
	{
		//return array("command.su.update_docs");
	}
}