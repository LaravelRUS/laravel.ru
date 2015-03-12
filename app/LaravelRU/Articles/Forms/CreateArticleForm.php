<?php namespace LaravelRU\Articles\Forms;

use Laracasts\Validation\FormValidator;

class CreateArticleForm extends FormValidator {

	protected $rules = [
		'title' => 'required|unique:articles',
		'slug' => 'required|unique:articles|slug',
		//'meta_description' => 'required|max:150',
		'difficulty_level_id' => "required",
		'text' => 'required',
	];

	protected $messages = [];

}
