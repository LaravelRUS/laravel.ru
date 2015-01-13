<?php namespace LaravelRU\Packages;

use Illuminate\Support\ServiceProvider;

class PackagesServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register Artisan command (if needed)
		$this->commands('LaravelRU\Packages\Commands\RefillPackagesCommand');
		$this->commands('LaravelRU\Packages\Commands\CheckNewPackagesCron');
		$this->commands('LaravelRU\Packages\Commands\UpdatePackagesCron');

		// Including module-related routes etc
		include __DIR__ . DIRECTORY_SEPARATOR . 'package_widgets.php';
	}

}
