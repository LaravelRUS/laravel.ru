<?php

use LaravelRU\News\Repositories\NewsRepo;
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

	public function __construct(PostRepo $postRepo, NewsRepo $newsRepo)
	{
		$this->postRepo = $postRepo;
		$this->newsRepo = $newsRepo;
	}

	public function home()
	{
		$lastPosts = $this->postRepo->getLastPosts();
		$lastNews = $this->newsRepo->getLastNews(5);

		return View::make("home", compact("lastPosts", "lastNews"));
	}



} 