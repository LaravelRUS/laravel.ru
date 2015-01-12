<?php namespace LaravelRU\Common;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Add folder Views in global views path. Use subfolder 'user' for place module views.
		$viewPaths = $this->app['config']->get('view.paths');
		$viewPaths[] = __DIR__ . DIRECTORY_SEPARATOR . 'Views';

		$this->app['config']->set('view.paths', $viewPaths);

		include __DIR__ . DIRECTORY_SEPARATOR . 'common_helpers.php';
		include __DIR__ . DIRECTORY_SEPARATOR . 'common_widgets.php';
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		include __DIR__ . DIRECTORY_SEPARATOR . 'common_macro.php';
	}

}


