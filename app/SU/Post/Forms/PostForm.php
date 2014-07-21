<?php namespace SU\Post\Forms;

use Laracasts\Validation\FormValidator;

class PostForm extends FormValidator{

	protected $rules = [
			'field1'   => 'required|min:6',
			'field2'   => 'required|max:8',
			'i_agree'  => 'required'
	];

	protected $messages = [
			'i_agree.required' => "Вы должны согласиться с правилами правила.",
	];

} 