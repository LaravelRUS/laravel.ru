<?php namespace SU\Post\Controllers;

use SU\Post\Access\PostAccess;
use SU\Post\Forms\PostForm;
use Laracasts\Validation\FormValidationException;
use SU\Post\Models\PostRepo;

class PostController extends \BaseController {

	private $postForm;
	/**
	 * @var PostAccess
	 */
	private $access;
	/**
	 * @var PostRepo
	 */
	private $postRepo;

	public function __construct(PostAccess $access, PostForm $postForm, PostRepo $postRepo)
	{
		$this->postForm = $postForm;
		$this->access = $access;
		$this->postRepo = $postRepo;
	}

	public function create()
	{
		$post = $this->postRepo->create(['is_draft'=>'1']);
		return \View::make("post/edit_post", compact("post"));
	}

	public function edit($id)
	{
		$this->access->checkEditPost($id);

		$post = $this->postRepo->find($id);

		return \View::make("post/edit_post", compact("post"));
	}

	public function store()
	{
		$id = \Input::get("post_id");
		$this->access->checkEditPost($id);
	}

}