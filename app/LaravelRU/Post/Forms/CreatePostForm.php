<?php namespace LaravelRU\Post\Forms;

use Laracasts\Validation\FormValidator;

class CreatePostForm extends FormValidator{

	protected $rules = [
		'title'   => 'required',
		'slug'    => 'required|unique:posts,slug|regex:/^[A-Za-z0-9\-]+$/',
		'text'    => 'required',
	];

	protected $messages = [
	];

} 