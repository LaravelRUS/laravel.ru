<?php namespace SU\User\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter{

	public function name()
	{
        return "<a class='user' href='".route("user.blog")."'>$this->name</a>";
	}

}