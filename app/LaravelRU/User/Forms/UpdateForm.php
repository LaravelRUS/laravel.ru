<?php namespace LaravelRU\User\Forms;

use Auth;
use Laracasts\Validation\FormValidator;

class UpdateForm extends FormValidator {

	protected $messages = [
		'info_birthday.date' => 'Дата рождения имеет неверный формат. Пример, 2000-12-31',
		'info_birthday.date_format' => 'Дата рождения имеет неверный формат. Пример, 2000-12-31',
		'info_site.url' => 'Указанный адрес сайта является некорректным',
	];

	public function getValidationRules()
	{
		return [
			'username' => 'required|username|unique:users,username,' . Auth::id(),
			'email' => 'required|email|unique:users,email,' . Auth::id(),
			'fullname' => '',

			'social_vkontakte' => 'social:vkontakte',
			'social_facebook' => 'social:facebook',
			'social_twitter' => 'social:twitter',
			'social_github' => 'social:github',
			'social_bitbucket' => 'social:bitbucket',
			'social_google' => 'social:google',

			'info_about' => '',
			'info_birthday' => 'date|date_format:Y-m-d',
			'info_site' => 'url',
			'info_skype' => 'alphaNumDashDot',
		];
	}

}
