<?php namespace LaravelRU\News\Forms;

use Laracasts\Validation\FormValidator;

class UpdateNewsForm extends FormValidator {

	protected $rules = [
		'text' => 'required',
	];

	protected $messages = [
	];

} 