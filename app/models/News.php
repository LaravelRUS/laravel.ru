<?php

use LaravelRU\Likes\LikeableTrait;
use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class News extends Model {

	use CommentableTrait, SoftDeletingTrait, LikeableTrait;

	protected $dates = ['deleted_at'];

	public function author()
	{
		return $this->belongsTo('User');
	}

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	public function scopeApproved()
	{
		return $this->where('is_approved', 1);
	}

	public function scopeNotDraft()
	{
		return $this->where('is_draft', 0);
	}

}
