<?php

use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends Model {

	use CommentableTrait;

	use SoftDeletingTrait;

	const PUBLISHED_AT = 'published_at';

	protected $guarded = ['id', 'author_id'];
	protected $dates = ['deleted_at', self::PUBLISHED_AT];

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	public function framework_version()
	{
		return $this->belongsTo('Version');
	}

	public function scopeNotDraft($query)
	{
		return $query->where('is_draft', 0);
	}

}
