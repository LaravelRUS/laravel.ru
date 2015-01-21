<?php namespace LaravelRU\HTML;

use Jevix as BaseJevix;

class Jevix extends BaseJevix implements HtmlPurifier
{
	public function parse($text, &$errors = [])
	{
		return parent::parse($text, $errors);
	}
}
