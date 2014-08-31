<?php

use LaravelRU\Post\Repositories\PostRepo;
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

	public function __construct(UserRepo $userRepo, PostRepo $postRepo)
	{
		$this->userRepo = $userRepo;
		$this->postRepo = $postRepo;
	}



} 