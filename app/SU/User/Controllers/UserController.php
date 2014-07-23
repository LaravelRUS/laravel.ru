<?php namespace SU\User\Controllers;

use SU\Core\Controllers\BaseController;
use SU\Post\Models\PostRepo;
use SU\User\Models\User;
use SU\User\Models\UserRepo;

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