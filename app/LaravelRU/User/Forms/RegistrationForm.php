<?php namespace LaravelRU\User\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'username' => 'required|min:4|max:23|unique:users,username|regex:/^[A-Za-z0-9]+$/',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6',
		'jtoken' => 'required|jstoken'
	];

	protected $messages = [
		'username.unique' => 'Такой никнейм уже занят.',
		'email.unique' => 'Пользователь с таким мейлом уже есть в системе.',
		'jtoken.required' => 'Антибот-проверка не пройдена. Включите javascript.',
		'jtoken.jstoken' => 'Антибот-проверка не пройдена. Включите javascript.'
	];

}