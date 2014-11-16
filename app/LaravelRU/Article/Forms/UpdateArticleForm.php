<?php namespace LaravelRU\Article\Forms;

use Laracasts\Validation\FormValidator;

class UpdateArticleForm extends FormValidator{

	protected $rules = [
		'title'   => 'required',
		'slug'    => 'required|regex:/^[A-Za-z0-9\-]+$/',
		'text'    => 'required',
	];

	protected $messages = [
	];

} 