<?php

use LaravelRU\Likes\LikeableTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	use LikeableTrait;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function commentable()
	{
		return $this->morphTo();
	}

}
