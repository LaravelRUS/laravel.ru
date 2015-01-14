<?php

use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tip extends Model {

	use CommentableTrait;

	use SoftDeletingTrait;

	use LikeableTrait;

	const PUBLISHED_AT = 'published_at';

	protected $dates = ['deleted_at', self::PUBLISHED_AT];

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

	public function version()
	{
		return $this->belongsTo('Version');
	}

}
