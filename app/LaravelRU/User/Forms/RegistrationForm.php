<?php namespace LaravelRU\User\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	protected $rules = [
		'name' => 'required|min:4|max:23|unique:users,name|regex:/^[A-Za-z0-9]+$/',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6',
		'i_agree' => 'required',
		'js_token' => 'required|jstoken',
		//'g-recaptcha-response' => 'required|captcha'
		//'g-recaptcha-response' => 'required|recaptcha',
	];

	protected $messages = [
		'i_agree.required' => 'Вы должны согласиться выполнять правила.',
		'name.unique' => 'Такой никнейм уже занят.',
		'email.unique' => 'Пользователь с таким мейлом уже есть в системе.',
		'g-recaptcha-response.required' => 'Вы должны показать, что вы не бот.',
		'g-recaptcha-response.captcha' => 'Антиспам-проверка не пройдена.',
		"recaptcha" => 'Капча некорректна.',
		'js_token.required' => 'Антибот-проверка не пройдена. Включите javascript.',
		'js_token.jstoken' => 'Антибот-проверка не пройдена. Включите javascript.',
	];

}