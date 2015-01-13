<?php namespace LaravelRU\Docs;

use Illuminate\Support\ServiceProvider;
use LaravelRU\Docs\Commands\UpdateDocsCommand;

class DocsServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->commands('LaravelRU\Docs\Commands\UpdateDocsCron');

		include __DIR__ . DIRECTORY_SEPARATOR . 'docs_widgets.php';
	}

}
