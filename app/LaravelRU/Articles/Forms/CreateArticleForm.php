<?php namespace LaravelRU\Articles\Forms;

use Laracasts\Validation\FormValidator;

class CreateArticleForm extends FormValidator {

	protected $rules = [
		'id' => 'required|exists:articles',
		'title' => 'required|unique:articles',
		'slug' => 'required|unique:articles|slug',
		'meta_description' => 'required|max:150',
		'text' => 'required',
	];

	protected $messages = [];

}
