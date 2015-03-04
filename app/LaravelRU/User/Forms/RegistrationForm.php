<?php namespace LaravelRU\User\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'username' => 'required|username|min:2|max:23|unique:users|unique:restricted_words,title',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6',
		'jsToken' => 'required|js_token'
	];

	protected $messages = [
		'username.unique' => 'Этот логин уже кем-то занят',
		'email.unique' => 'Этот Email уже кем-то занят',
		'jsToken.required' => 'Антибот-проверка не пройдена. Включите javascript',
		'jsToken.js_token' => 'Антибот-проверка не пройдена. Включите javascript'
	];

}
