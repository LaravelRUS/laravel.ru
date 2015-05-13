<?php namespace LaravelRU\DocsSleepingowlAdmin;

use Illuminate\Support\ServiceProvider;

class DocsSleepingowlAdminServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->commands('LaravelRU\DocsSleepingowlAdmin\Commands\UpdateDocsSleepingowlAdminCron');

	}

}
