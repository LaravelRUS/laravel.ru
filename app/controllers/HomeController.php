<?php

use LaravelRU\News\Repositories\NewsRepo;
use LaravelRU\Packages\PackageRepo;
use LaravelRU\Post\Repositories\PostRepo;
use LaravelRU\Sidebar\Sidebar;

class HomeController extends BaseController{

	/**
	 * @var PostRepo
	 */
	private $postRepo;
	/**
	 * @var NewsRepo
	 */
	private $newsRepo;
	/**
	 * @var PackageRepo
	 */
	private $packageRepo;

	public function __construct(PostRepo $postRepo, NewsRepo $newsRepo, PackageRepo $packageRepo)
	{
		$this->postRepo = $postRepo;
		$this->newsRepo = $newsRepo;
		$this->packageRepo = $packageRepo;
	}

	public function home()
	{
		$lastPosts = $this->postRepo->getLastPosts();
		$lastNews = $this->newsRepo->getLastNews(5);
		$newPackages = $this->packageRepo->getLastCreated();

		return View::make("home", compact("lastPosts", "lastNews", "newPackages"));
	}



} 