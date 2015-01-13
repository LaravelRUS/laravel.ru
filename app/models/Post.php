<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends Eloquent {

	use SoftDeletingTrait;


	protected  $guarded = ['id','author_id'];

	protected  $dates 	= ['deleted_at', 'published_at'];

	public function author()
	{
		return $this->belongsTo('User', "author_id");
	}

	public function comments()
	{
		return $this->morphMany("Comment", "commentable");
	}

	public function framework_version()
	{

		return $this->belongsTo("Version");
	}

	public function scopeNotDraft($query)
	{
		return $query->where("is_draft", 0);
	}

};
