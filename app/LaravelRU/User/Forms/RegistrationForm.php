<?php namespace LaravelRU\User\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'username' => 'required|username|min:4|max:23|unique:users,username',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6',
		'jtoken' => 'required|jstoken'
	];

	protected $messages = [
		'username.unique' => 'Этот логин уже кем-то занят',
		'email.unique' => 'Этот Email уже кем-то занят',
		'jtoken.required' => 'Антибот-проверка не пройдена. Включите javascript',
		'jtoken.jstoken' => 'Антибот-проверка не пройдена. Включите javascript'
	];

}
