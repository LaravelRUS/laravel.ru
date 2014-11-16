<?php

use LaravelRU\Article\Repositories\ArticleRepo;
use LaravelRU\User\Repositories\UserRepo;

class UserController extends BaseController{

	/**
	 * @var UserRepo
	 */
	private $userRepo;
	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	public function __construct(UserRepo $userRepo, ArticleRepo $articleRepo)
	{
		$this->userRepo = $userRepo;
		$this->articleRepo = $articleRepo;
	}



} 