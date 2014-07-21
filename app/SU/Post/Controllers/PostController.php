<?php namespace SU\Post\Controllers;

use SU\Post\Forms\PostForm;
use Laracasts\Validation\FormValidationException;

class PostController extends \BaseController {

	private $postForm;

	public function __construct(PostForm $postForm)
	{
		$this->postForm = $postForm;
	}

	public function getExample()
	{
		return \View::make("post::post/example");
	}

	public function postExample()
	{
		$input = \Input::only('field1', 'field2');
		try{
			$this->postForm->valdate($input);
		}
		catch (FormValidationException $e)
        {
            return \Redirect::back()->withInput()->withErrors($e->getErrors());
        }

		return \Redirect::back()->withSuccess(true);
	}
}