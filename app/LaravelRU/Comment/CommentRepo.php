<?php namespace LaravelRU\Comment;

use Auth;
use LaravelRU\Core\Repository\AbstractRepository;
use LaravelRU\Comment\Models\Comment;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class CommentRepo
 *
 * @package LaravelRU\Comment
 */
class CommentRepo extends AbstractRepository {

	public function __construct(Comment $comment)
	{
		$this->model = $comment;
	}

	/**
	 * ID автора коммента
	 *
	 * @param int $comment_id
	 * @return int
	 */
	public function getAuthorId($comment_id)
	{
		$author_id = $this->model->where('id', $comment_id)->pluck('author_id');

		return $author_id;

	}


	/**
	 * @param $commentable_type string
	 * @param $commentable_id int, numeric
	 * @param $comment Comment
	 * @return Comment
	 */
	public function storeComment($comment, $commentable_type = '', $commentable_id = 0)
	{
		$comment->author_id = Auth::id();

		if( isset( $comment->id ) )
		{
			dd($comment);
			return $comment->save();
		}

		if( $this->isCommentable($commentable_type) )
		{
			$commentable = new $commentable_type;
			$commentable = $commentable->find($commentable_id);

			$comment = $commentable->comments()->save($comment);

			return $comment;
		};

		throw new BadRequestHttpException;
	}

	public function getCommentById($id)
	{
		return $this->model->first($id);
	}
	/**
	 * Последние комментарии
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastComments($num = 10)
	{
		return $this->model
						->notDraft()
						->with('author')
						->orderBy(Post::PUBLISHED_AT, 'desc')
						->limit($num)->get();
	}

	/**
	 * @param $commentableClassName string
	 * @return bool
	 */
	protected function isCommentable($commentableClassName)
	{


		if( is_subclass_of($commentableClassName, 'LaravelRU\Comment\CommentableInterface') ) return true;

		return false;
	}

}
