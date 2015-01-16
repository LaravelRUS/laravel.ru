<?php namespace LaravelRU\Comment\Models;

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
		return $this->belongsTo('LaravelRU\User\Models\User', 'author_id');
	}

}
