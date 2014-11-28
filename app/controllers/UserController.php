<?php

use LaravelRU\Post\PostRepo;
use LaravelRU\Tips\TipsRepo;
use LaravelRU\User\Repositories\UserRepo;

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

	public function profile()
	{
		$user = Auth::user()->with("posts")->with("tips")->with("news");

		return View::make("user/profile", compact("user"));
	}



} 