<?php namespace SU\Docs;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use SU\Docs\Commands\UpdateDocsCommand;

class DocsServiceProvider extends ServiceProvider{

	public function register()
	{
		// Module routes
		require __DIR__ . '/routes.php';

		// Module views
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/Views';
		\Config::set('view.paths', $viewPaths);

//		$this->app['command.su.update_docs'] = $this->app->share(function($app)
//		{
//			return new UpdateDocsCommand;
//		});
//		$this->commands('command.su.update_docs');

		$this->commands('SU\Docs\Commands\UpdateDocsCommand');

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