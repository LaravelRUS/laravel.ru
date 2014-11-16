<?php namespace LaravelRU\Sidebar;

use LaravelRU\Article\Repositories\ArticleRepo;
use View;

class Sidebar {

	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	public function __construct(ArticleRepo $articleRepo)
	{
		$this->articleRepo = $articleRepo;
	}

	public function renderLastArticles($num_articles = 6)
	{
		$articles = $this->articleRepo->getLastArticles($num_articles);
		return View::make("sidebar/sidebar_last_articles", compact("articles"));
	}


	public function typicalSidebar()
	{
		return $this->renderLastArticles();
	}



} 