<?php namespace LaravelRU\Comment;

use LaravelRU\Comment\Models\Comment;

interface CommentableInterface {

	public function comments();

	public function storeComment(Comment $comment);

	public function scopeWithComments($query);

}