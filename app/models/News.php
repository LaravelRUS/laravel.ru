<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class News extends Eloquent {

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
