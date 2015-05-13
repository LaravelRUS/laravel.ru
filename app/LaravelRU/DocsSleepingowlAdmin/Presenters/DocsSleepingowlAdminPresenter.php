<?php namespace LaravelRU\DocsSleepingowlAdmin\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;
use Markdown;

class DocsSleepingowlAdminPresenter extends Presenter {

	public function lastCommitDate()
	{
		return LocalizedCarbon::instance($this->last_commit_at)->formatLocalized('%d %f');
	}

	public function documentText()
	{
		return Markdown::render($this->text);
	}

}