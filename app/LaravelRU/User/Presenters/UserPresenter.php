<?php namespace LaravelRU\User\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;

class UserPresenter extends Presenter {

	public function fullname()
	{
		if ( ! $this->info->name && ! $this->info->surname) return $this->entity->username;

		return $this->info->name . ' ' . $this->info->surname;
	}

	public function birthday()
	{
		return LocalizedCarbon::createFromFormat('Y-m-d', $this->info->birthday)->formatLocalized('%e %f %Y');
	}

	public function created_at()
	{
		return LocalizedCarbon::instance($this->entity->created_at)->formatLocalized('%e %f %Y в %H:%M');
	}

}
