<?php

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function commentable()
	{
		return $this->morphTo();
	}

}
