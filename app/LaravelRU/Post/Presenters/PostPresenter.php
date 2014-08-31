<?php namespace LaravelRU\Post\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class PostPresenter extends Presenter{

	public function html()
	{
//		if($this->parser_type == "markdown"){
//			$parsedown = new \Parsedown();
//			$html = $parsedown->text($this->text);
//		}
//		if($this->parser_type == "uversewiki"){
//			$html = $this->text;
//		}
		$html = $this->_parse($this->text);
		return $html;
	}

	private function _parse($text)
	{
		if($this->parser_type == "markdown"){
			$parsedown = new \Parsedown();
			$html = $parsedown->text($text);
		}
		if($this->parser_type == "uversewiki"){
			$html = $text;
		}
		return $html;
	}

	public function short_html()
	{
		//$description = str_limit($this->text, 20, "&nbsp;".link_to_route("post.view", [$this->slug], "дальше"));
		$description = str_limit($this->text, 300, "&nbsp;..");
		$html =  $this->_parse($description);
		$html = strip_tags($html);
		return $html;
	}

	public function date()
	{
		$date = $this->published_at->format("d M");
		return $date;
	}

}