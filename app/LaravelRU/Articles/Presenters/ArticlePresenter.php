<?php namespace LaravelRU\Articles\Presenters;

use Laracasts\Presenter\Presenter;
use LocalizedCarbon;
use Markdown;

class ArticlePresenter extends Presenter {

	public function publishedAt()
	{
		if($this->published_at){
			return LocalizedCarbon::instance($this->published_at)->formatLocalized('%d %f');
		}else{
			return "не опубликовано";
		}

	}

	public function textMD()
	{
		return Markdown::render($this->text);
	}

}