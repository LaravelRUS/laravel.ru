<?php namespace LaravelRU\Likes;

trait LikeableTrait {

	public function likes()
	{
		return $this->morphMany('Likes', 'likeable');
	}

	public function addLike(Likes $like)
	{
		return $this->likes()->save($like);
	}

	public function withLikesCount()
	{
		return $this->with('likes')->count();
	}

}