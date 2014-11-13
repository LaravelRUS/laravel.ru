<?php namespace LaravelRU\News\Forms;

use Laracasts\Validation\FormValidator;

class CreateNewsForm extends FormValidator{

	protected $rules = [
		'text'    => 'required',
	];

	protected $messages = [
	];

} 