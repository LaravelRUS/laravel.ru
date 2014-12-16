<?php namespace LaravelRU\Docs\Workers;

use Artisan;

class UpdateDocsWorker {

	public function fire($job)
	{

		Artisan::call("su:update_docs");
		$job->delete();
	}

}