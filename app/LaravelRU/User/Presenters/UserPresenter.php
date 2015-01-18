<?php namespace LaravelRU\User\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function blog()
	{
		return '<a class="user" href="' . route('user.blog', [$this->username]) . '">' . $this->username . '</a>';
	}

}