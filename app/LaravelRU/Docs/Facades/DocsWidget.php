<?php namespace LaravelRU\Docs\Facades;

use Illuminate\Support\Facades\Facade;

class DocsWidget extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'docswidget';
	}

}
