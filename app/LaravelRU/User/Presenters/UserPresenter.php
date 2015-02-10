<?php namespace LaravelRU\User\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;

class UserPresenter extends Presenter {

	public function fullname()
	{
		return $this->info->name . ' ' . $this->info->surname;
	}

	public function birthday()
	{
		return LocalizedCarbon::createFromFormat('Y-m-d', $this->info->birthday)->formatLocalized('%e %f %Y');
	}

	public function created_at()
	{
		return LocalizedCarbon::createFromFormat('Y-m-d H:i:s', $this->entity->created_at)->formatLocalized('%e %f %Y в %H:%M');
	}

}
