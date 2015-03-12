<?php namespace LaravelRU\Articles\Forms;

use Laracasts\Validation\FormValidator;

class UpdateArticleForm extends FormValidator {

	protected $rules = [
		'title' => 'required|unique:articles',
		'slug' => 'required|unique:articles|slug',
		'difficulty_level_id' => "required",
		'text' => 'required',
	];

	protected $messages = [];

}
