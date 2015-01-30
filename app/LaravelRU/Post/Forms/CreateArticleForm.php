<?php namespace LaravelRU\Post\Forms;

use Laracasts\Validation\FormValidator;

class CreatePostForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|unique:posts,slug|slug',
		'text' => 'required',
	];

	protected $messages = [];

}
