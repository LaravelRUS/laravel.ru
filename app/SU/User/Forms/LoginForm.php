<?php namespace SU\User\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator{

	protected $rules = [
		'email'      => 'required|email|exists:users',
		'password'   => 'required',
	];

	protected $messages = [
	];

} 