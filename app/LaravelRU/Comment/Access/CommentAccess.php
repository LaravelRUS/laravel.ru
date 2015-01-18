<?php namespace LaravelRU\Comment\Access;

use Auth;
use LaravelRU\Core\Access\BaseAccess;
use LaravelRU\Comment\CommentRepo;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CommentAccess extends BaseAccess {


	/**
	 * Время для редактирования поста в секундах
	 *
	 * @const int
	 */
	const EDIT_TIME = 150;

	/**
	 * @var CommentRepo
	 */
	private $commentRepo;

	public function __construct(CommentRepo $commentRepo)
	{
		$this->commentRepo = $commentRepo;

	}

	/**
	 * @param $id int
	 * @return void
	 */
	public function checkEditComment($id)
	{
		$comment = $this->commentRepo->getCommentById($id);

		if ( ! $comment)
		{
			throw new NotFoundHttpException;
		}

		if ( Auth::id() != $comment->autor_id || $this->checkEditComment($comment))
		{
			throw new AccessDeniedException;
		}

	}

	protected function checkEditTime($comment)
	{
		return (time() - $comment->created_at->timestamp < static::EDIT_TIME);
	}

}
