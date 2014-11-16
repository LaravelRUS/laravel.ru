<?php namespace LaravelRU\Article\Forms;

use Laracasts\Validation\FormValidator;

class CreateArticleForm extends FormValidator{

	protected $rules = [
		'title'   => 'required',
		'slug'    => 'required|unique:articles,slug|regex:/^[A-Za-z0-9\-]+$/',
		'text'    => 'required',
	];

	protected $messages = [
	];

} 