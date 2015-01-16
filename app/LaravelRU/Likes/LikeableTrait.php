<?php namespace LaravelRU\Likes;

use LaravelRU\Likes\Models\Like;

trait LikeableTrait {

	public function likes()
	{
		return $this->morphMany('LaravelRU\Likes\Models\Like', 'likeable');
	}

	public function addLike(Like $like)
	{
		return $this->likes()->save($like);
	}

	public function withLikesCount()
	{
		return $this->with('likes')->count();
	}

}