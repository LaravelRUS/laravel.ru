<?php namespace LaravelRU\User\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function fullname()
	{
		return $this->info->name . ' ' . $this->info->surname;
	}

}