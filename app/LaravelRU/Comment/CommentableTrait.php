<?php namespace LaravelRU\Comment;

use \Comment;

trait CommentableTrait {

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	public function storeComment(Comment $comment)
	{
		return $this->comments()->save($comment);
	}

	public function scopeWithComments($query)
	{
		return $query->with('comments');
	}

}