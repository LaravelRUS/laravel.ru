<?php

use LaravelRU\Docs\Models\Documentation;
use LaravelRU\News\Repositories\NewsRepo;
use LaravelRU\Packages\PackageRepo;
use LaravelRU\Articles\ArticleRepo;

class HomeController extends BaseController {

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

		$newPackages = $this->packageRepo->getLastCreated();
		$updatedPackages = $this->packageRepo->getLastUpdated();

		$updatedDocs = Documentation::with('frameworkVersion')->orderByLastCommit()->limit(12)->get();

		return View::make('home.home-page', compact(
			'lastArticles', 'lastNews', 'newPackages', 'updatedPackages', 'updatedDocs'
		));
	}

}
