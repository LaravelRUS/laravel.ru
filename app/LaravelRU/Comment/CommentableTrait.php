<?php namespace LaravelRU\Comment;

use LaravelRU\Comment\Models\Comment;

trait CommentableTrait {

	public function comments()
	{
		return $this->morphMany('LaravelRU\Comment\Models\Comment', 'commentable');
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