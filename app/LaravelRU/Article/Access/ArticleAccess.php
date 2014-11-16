<?php namespace LaravelRU\Article\Access;

use LaravelRU\Core\Access\BaseAccess;
use LaravelRU\Article\Repositories\ArticleRepo;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ArticleAccess extends BaseAccess{

	/**
	 * @var ArticleRepo
	 */
	private $articleRepo;

	public function __construct(ArticleRepo $articleRepo)
	{
		$this->articleRepo = $articleRepo;
	}

	public function checkEditPost($id)
	{
		if(\Auth::id() != $this->articleRepo->getAuthorId($id)){
			throw new AccessDeniedException;
		}
	}

	public function checkEditPostBySlug($slug)
	{
		if(\Auth::id() != $this->articleRepo->getAuthorIdBySlug($slug)){
			throw new AccessDeniedException;
		}
	}

} 