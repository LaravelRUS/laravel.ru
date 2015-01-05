<?php namespace LaravelRU\Core;

use Illuminate\Support\ServiceProvider;
use Session;
use Validator;

class CoreServiceProvider extends ServiceProvider{

	public function register()
	{
		// Регистрация сервис-провайдеров приложения
		$this->app->register('LaravelRU\Docs\DocsServiceProvider');
		$this->app->register('LaravelRU\User\UserServiceProvider');
		$this->app->register('LaravelRU\Post\PostServiceProvider');
		$this->app->register('LaravelRU\Sidebar\SidebarServiceProvider');
		$this->app->register('LaravelRU\Common\CommonServiceProvider');
		$this->app->register('LaravelRU\Access\AccessServiceProvider');
		$this->app->register('LaravelRU\Parser\ParserServiceProvider');
		$this->app->register('LaravelRU\News\NewsServiceProvider');
		$this->app->register('LaravelRU\Packages\PackagesServiceProvider');




		// регистрация папки Views
//		$viewPaths = \Config::get('view.paths');
//		$viewPaths[] = __DIR__ . '/Views';
//		\Config::set('view.paths', $viewPaths);

		include __DIR__.'/core_exceptions.php';
		//include __DIR__.'/core_routes.php';
//		include __DIR__ . '/core_helpers.php';

	}

	public function boot()
	{
		$this->addValidators();
	}

	/**
	 * Extends Validator to include a recaptcha type
	 */
	public function addValidators()
	{
		//$validator = $this->app['Validator'];

		Validator::extend('jstoken', function($attribute, $value, $parameters)
		{
			return Session::get("jsToken") == $value;
		});
	}
}