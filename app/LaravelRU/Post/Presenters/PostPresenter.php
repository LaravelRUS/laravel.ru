<?php namespace LaravelRU\Post\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;
use Markdown;

class PostPresenter extends Presenter {

	public function publishedAt()
	{
		return LocalizedCarbon::instance($this->published_at)->formatLocalized('%d %f');
	}

	public function textMD()
	{
		return Markdown::render($this->text);
	}

}