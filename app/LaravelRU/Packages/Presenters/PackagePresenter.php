<?php namespace LaravelRU\Packages\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;

class PackagePresenter extends Presenter {

	public function creationDate()
	{
		return LocalizedCarbon::instance($this->created_at)->formatLocalized('%d %f');
	}

}