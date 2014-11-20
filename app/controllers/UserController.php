<?php

use LaravelRU\Article\Repositories\ArticleRepo;
use LaravelRU\Tips\TipsRepo;
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
	/**
	 * @var TipsRepo
	 */
	private $tipsRepo;

	public function __construct(UserRepo $userRepo, ArticleRepo $articleRepo, TipsRepo $tipsRepo)
	{
		$this->userRepo = $userRepo;
		$this->articleRepo = $articleRepo;
		$this->tipsRepo = $tipsRepo;
	}

	public function profile()
	{
		$user = Auth::user()->with("articles")->with("tips")->with("news");

		return View::make("user/profile", compact("user"));
	}



} 