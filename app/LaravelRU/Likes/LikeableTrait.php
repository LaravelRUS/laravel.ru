<?php namespace LaravelRU\Likes;

use \Like;

trait LikeableTrait {

	public function likes()
	{
		return $this->morphMany('Like', 'likeable');
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