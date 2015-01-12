<?php

class Comment extends Eloquent {

	protected $table = 'comments';

	/**
	 * Ralations
	 */

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function commentable()
	{
		return $this->morphTo();
	}

}
