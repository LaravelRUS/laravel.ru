<?php

use LaravelRU\Sidebar\Sidebar;

class HomeController extends BaseController{

	/**
	 * @var Sidebar
	 */
	private $sidebar;

	public function __construct(Sidebar $sidebar)
	{
		$this->sidebar = $sidebar;
	}

	public function home()
	{
		$last_posts = $this->sidebar->renderLastPosts();

		return View::make("home", compact("last_posts"));
	}



} 