<?php namespace LaravelRU\Tips\Forms;

use Laracasts\Validation\FormValidator;

class CreateTipForm extends FormValidator{

	protected $rules = [
		'text'    => 'required',
	];

	protected $messages = [
	];

} 