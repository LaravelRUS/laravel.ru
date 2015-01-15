<?php namespace LaravelRU\Docs\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;
use Markdown;

class DocsPresenter extends Presenter {

	public function lastCommitDate()
	{
		return LocalizedCarbon::instance($this->created_at)->formatLocalized('%d %f');
	}

	public function documentText()
	{
		return Markdown::render($this->text);
	}

}