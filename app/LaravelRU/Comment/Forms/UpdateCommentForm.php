<?php namespace LaravelRU\Comment\Forms;

use Laracasts\Validation\FormValidator;

class UpdateCommentForm extends FormValidator{

	protected $rules = [
		'text' => 'required',
	    'id'   => 'exists:comments,id'
	];

	protected $messages = [];

}