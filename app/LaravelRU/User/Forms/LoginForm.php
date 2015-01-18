<?php namespace LaravelRU\User\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator {

	protected $rules = [
		'login' => 'required',
		'password' => 'required',
	];

	protected $messages = [];

}