<?php namespace LaravelRU\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider{

	public function register()
	{
		// Регистрация сервис-провайдеров приложения
		$this->app->register('LaravelRU\Docs\DocsServiceProvider');
		$this->app->register('LaravelRU\User\UserServiceProvider');
		$this->app->register('LaravelRU\Post\PostServiceProvider');
		$this->app->register('LaravelRU\Blog\BlogServiceProvider');
		$this->app->register('LaravelRU\Sidebar\SidebarServiceProvider');

		// регистрация папки Views
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/Views';
		\Config::set('view.paths', $viewPaths);

		include __DIR__.'/core_exceptions.php';
		//include __DIR__.'/core_routes.php';
		include __DIR__.'/core_helpers.php';

	}

	public function boot()
	{

	}
}