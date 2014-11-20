<?php namespace LaravelRU\Tips\Forms;

use Laracasts\Validation\FormValidator;

class UpdateTipForm extends FormValidator{

	protected $rules = [
		'text'    => 'required',
	];

	protected $messages = [
	];

} 