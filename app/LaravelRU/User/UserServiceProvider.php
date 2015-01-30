<?php namespace LaravelRU\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		include 'user_helpers.php';
		include 'user_events.php';

		$this->registerValidatorRules();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Including module-related routes etc
		include 'user_filters.php';

		$this->commands('LaravelRU\User\Commands\UserCommand');
	}

	private function registerValidatorRules()
	{
		$validator = $this->app['validator'];

		include 'user_validator_rules.php';
	}

}
