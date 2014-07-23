<?php namespace SU\User\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator{

	protected $rules = [
		'name'          => 'required|min:4|max:23|unique:users,name|regex:[a-zA-Z0-9]+',
		'email'         => 'required|email|unique:users,email',
		'password'      => 'required|min:6',
		'i_agree'       => 'required'
	];

	protected $messages = [
		'i_agree.required' => "Вы должны согласиться выполнять правила.",
		'name.unique' => "Такой никнейм уже занят.",
		'email.unique' => "Пользователь с таким мейлом уже есть в системе."
	];

} 