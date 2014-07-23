<?php namespace SU\Blog\Controllers;

use SU\Post\Models\PostRepo;
use SU\User\Models\UserRepo;

class BlogController extends \BaseController {

	/**
	 * @var UserRepo
	 */
	private $userRepo;
	/**
	 * @var PostRepo
	 */
	private $postRepo;

	public function __construct(UserRepo $userRepo, PostRepo $postRepo)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
	}

	public function blog($username)
	{
		$user = $this->userRepo->getByName($username);
		$posts = $user->posts()->paginate(10);
		return \View::make("blog/user_blog", compact("posts", "user"));
	}


}