<?php namespace LaravelRU\Articles\Forms;

use Laracasts\Validation\FormValidator;

class CreateArticleForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|unique:posts,slug|slug',
		'text' => 'required',
	];

	protected $messages = [];

}
