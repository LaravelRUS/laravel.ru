<?php namespace LaravelRU\Term\Forms;

use Laracasts\Validation\FormValidator;

class TermForm extends FormValidator{

	protected $rules = [
		'terms'   => 'required',
		'text'    => 'required',
	];

	protected $messages = [
		'terms.required' => "Должен существовать хотя бы один термин.",
		'text.required' => "Описание термина не может быть пустым."
	];

} 