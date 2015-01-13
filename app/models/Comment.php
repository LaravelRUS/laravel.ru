<?php

<<<<<<< HEAD
class Comment extends \Eloquent {

    public $timestamps = true;
=======
class Comment extends Eloquent {

	protected $table = 'comments';
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208

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
