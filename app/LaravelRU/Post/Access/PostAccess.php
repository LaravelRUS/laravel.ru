<?php namespace LaravelRU\Post\Access;

use LaravelRU\Core\Access\BaseAccess;
use LaravelRU\Post\Repositories\PostRepo;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostAccess extends BaseAccess{

	/**
	 * @var PostRepo
	 */
	private $postRepo;

	public function __construct(PostRepo $postRepo)
	{
		$this->postRepo = $postRepo;
	}

	public function checkEditPost($id)
	{
		if(\Auth::id() != $this->postRepo->getAuthorId($id)){
			throw new AccessDeniedException;
		}
	}

	public function checkEditPostBySlug($slug)
	{
		if(\Auth::id() != $this->postRepo->getAuthorIdBySlug($slug)){
			throw new AccessDeniedException;
		}
	}

} 