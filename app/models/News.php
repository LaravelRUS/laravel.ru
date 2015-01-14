<?php

use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class News extends Model {

	use CommentableTrait;

	use SoftDeletingTrait;

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
