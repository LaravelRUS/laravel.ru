<?php namespace LaravelRU\Comment;

use Comment;

trait CommentableControllerTrait {

	protected $commentableModelName;

	protected function setCommentableModelName($name)
	{
		$this->commentableModelName = $name;
	}

	// Todo: добавить валидацию. Greabock 16.01.15
	public function addComment($entityId)
	{

		$entity = forward_static_call([$this->commentableModelName, 'test'], $entityId);
		$comment = new Comment;
		$comment->text = Inut::get('text');
		$comment->author_id = Auth::user()->id;
		$entity->comments()->save();
	}

}