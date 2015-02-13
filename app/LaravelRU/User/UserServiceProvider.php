<?php namespace LaravelRU\User;

use Illuminate\Support\ServiceProvider;
use LaravelRU\User\Models\ActivityInterface;

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

		$this->registerUserListeners($this->app['auth']->user());
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

		$this->app->bindShared('Illuminate\Auth\UserInterface', function ($app)
		{
			return $app['auth']->user();
		});

		$this->app->bind('Illuminate\Auth\Reminders\PasswordBroker', 'auth.reminder');

		$this->commands('LaravelRU\User\Commands\UserCommand');
	}

	private function registerValidatorRules()
	{
		$validator = $this->app['validator'];

		include 'user_validator_rules.php';
	}

	/**
	 * @param \LaravelRU\User\Models\User $user
	 */
	private function registerUserListeners($user)
	{
		$this->app['events']->listen('auth.login', function ($user)
		{
			if ($user instanceof ActivityInterface) $user->touchLastLoginAt();
		});

		if ($user instanceof ActivityInterface)
		{
			$this->app->before(function () use ($user)
			{
				$user->touchLastActivityAt();
			});
		}
	}

}
