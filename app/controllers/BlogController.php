<?php

use LaravelRU\Article\Repositories\ArticleRepo;
use LaravelRU\User\Repositories\UserRepo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends BaseController {

	/**
	 * @var UserRepo
	 */
	private $userRepo;
	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	private $articlesOnPage;

	public function __construct(UserRepo $userRepo, ArticleRepo $articleRepo)
	{
		$this->userRepo = $userRepo;
		$this->articleRepo = $articleRepo;
		$this->articlesOnPage = 10;
	}

	public function blog($username)
	{
		$user = $this->userRepo->getByName($username);
		if( ! $user){
			throw new NotFoundHttpException();
		}

		if(Auth::id() == $user->id){
			$articles = $user->articles()->paginate($this->articlesOnPage);
			$is_author = true;
		}else{
			$articles = $user->articles()->notDraft()->paginate($this->articlesOnPage);
			$is_author = false;
		}

		return View::make("blog/user_blog", compact("articles", "user", 'is_author'));
	}


}