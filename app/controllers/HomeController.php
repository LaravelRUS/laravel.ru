<?php

use LaravelRU\News\Repositories\NewsRepo;
use LaravelRU\Packages\PackageRepo;
use LaravelRU\Article\Repositories\ArticleRepo;
use LaravelRU\Sidebar\Sidebar;

class HomeController extends BaseController{

	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;
	/**
	 * @var NewsRepo
	 */
	private $newsRepo;
	/**
	 * @var PackageRepo
	 */
	private $packageRepo;

	public function __construct(ArticleRepo $articleRepo, NewsRepo $newsRepo, PackageRepo $packageRepo)
	{
		$this->articleRepo = $articleRepo;
		$this->newsRepo = $newsRepo;
		$this->packageRepo = $packageRepo;
	}

	public function home()
	{
		$lastArticles = $this->articleRepo->getLastArticles();
		$lastNews = $this->newsRepo->getLastNews(5);

		$newPackages = $this->packageRepo->getLastCreated(10);
		$updatedPackages = $this->packageRepo->getLastUpdated(10);

		$updatedDocs = Docs::orderBy("last_commit_at", "desc")->limit(12)->get();

		return View::make("home", compact("lastArticles", "lastNews", "newPackages", "updatedPackages", "updatedDocs"));
	}



} 