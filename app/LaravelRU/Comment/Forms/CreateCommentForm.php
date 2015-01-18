<?php namespace LaravelRU\Comment\Forms;

use Laracasts\Validation\FormValidator;

class CreateCommentForm extends FormValidator{

	protected $rules = [
		'text' => 'required',
	];

	protected $messages = [];
}