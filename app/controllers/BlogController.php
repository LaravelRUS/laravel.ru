<?php

use LaravelRU\Post\PostRepo;
use LaravelRU\User\Repositories\UserRepo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends BaseController {

	/**
	 * @var UserRepo
	 */
	private $userRepo;
	/**
	 * @var PostRepo
	 */
	private $postRepo;

	private $postsOnPage;

	public function __construct(UserRepo $userRepo, PostRepo $postRepo)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
		$this->postsOnPage = 10;
	}

	public function blog($username)
	{
		$user = $this->userRepo->getByName($username);
		if( ! $user){
			throw new NotFoundHttpException();
		}

		if(Auth::id() == $user->id){
			$posts = $user->posts()->paginate($this->postsOnPage);
			$is_author = true;
		}else{
			$posts = $user->posts()->notDraft()->paginate($this->postsOnPage);
			$is_author = false;
		}

		return View::make("blog/user_blog", compact("posts", "user", 'is_author'));
	}


}