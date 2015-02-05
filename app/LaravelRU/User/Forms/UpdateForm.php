<?php namespace LaravelRU\User\Forms;

use Auth;
use Laracasts\Validation\FormValidator;

class UpdateForm extends FormValidator {

	protected $messages = [
		'birthday.date' => 'Дата рождения имеет неверный формат',
		'birthday.date_format' => 'Дата рождения имеет неверный формат',
		'website.url' => 'Указанный адрес сайта является некорректным',
	];

	public function getValidationRules()
	{
		return [
			//'username' => 'required|username|unique:users,username,' . Auth::id(),
			//'email' => 'required|email|unique:users,email,' . Auth::id(),
			'name' => 'min:3',
			'surname' => 'min:3',

			'about' => '',
			'birthday' => 'date|date_format:Y-m-d',
			'website' => 'url',
			'skype' => 'alphaNumDashDot',
		];
	}

}
