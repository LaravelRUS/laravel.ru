<?php

use LaravelRU\Post\PostRepo;
use LaravelRU\Tips\TipsRepo;
use LaravelRU\User\Repositories\UserRepo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends BaseController{

	/**
	 * @var UserRepo
	 */
	private $userRepo;
	/**
	 * @var PostRepo
	 */
	private $postRepo;
	/**
	 * @var TipsRepo
	 */
	private $tipsRepo;

	public function __construct(UserRepo $userRepo, PostRepo $postRepo, TipsRepo $tipsRepo)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
		$this->tipsRepo = $tipsRepo;
	}

	public function profile($name)
	{
		$user = User::where("name",$name)->with("posts")->with("tips")->with("news")->first();
		if( ! $user){
			throw new NotFoundHttpException;
		}

		$sidebar = Sidebar::renderLastPosts();

		return View::make("user/profile", compact("user"));
	}



} 