<?php namespace LaravelRU\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

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
		$this->app->register('LaravelRU\HTML\HtmlServiceProvider');

		include __DIR__ . '/core_exceptions.php';
	}

	public function boot()
	{
		$this->registerValidatorExtenders();
	}

	/**
	 * Extends Validator to include a recaptcha type
	 */
	public function registerValidatorExtenders()
	{
		$this->app['validator']->extend('jstoken', function ($attribute, $value, $parameters)
		{
			return $this->app['session']->get('jsToken') === $value;
		});

		$this->app['validator']->extend('slug', function ($attribute, $value, $parameters)
		{
			return preg_match('/^\b[a-z\pN-]+\b$/u', $value);
		});

		$this->app['validator']->extend('alphaNumDashDot', function ($attribute, $value, $parameters)
		{
			return preg_match('/^\b[a-z\pN\-_\.]+\b$/u', $value);
		});
	}

}
