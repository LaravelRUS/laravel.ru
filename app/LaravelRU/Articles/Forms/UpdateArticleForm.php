<?php namespace LaravelRU\Articles\Forms;

use Laracasts\Validation\FormValidator;

class UpdateArticleForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|slug',
		'difficulty_level_id' => "in:1,2,3",
		'text' => 'required',
	];

	protected $messages = [];

}
