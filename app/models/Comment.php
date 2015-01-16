<?php

use LaravelRU\Likes\LikeableTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	use LikeableTrait;

	public function commentable()
	{
		return $this->morphTo();
	}

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}
}
