<?php namespace LaravelRU\Sidebar;

use LaravelRU\Post\Repositories\PostRepo;
use View;

class Sidebar {

	/**
	 * @var PostRepo
	 */
	private $postRepo;

	public function __construct(PostRepo $postRepo)
	{
		$this->postRepo = $postRepo;
	}

	public function renderLastPosts($num_posts = 6)
	{
		$posts = $this->postRepo->getLastPosts($num_posts);
		return View::make("sidebar/sidebar_last_posts", compact("posts"));
	}


	public function typicalSidebar()
	{
		return $this->renderLastPosts();
	}



} 