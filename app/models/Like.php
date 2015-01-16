<?php

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	public function likeable()
	{
		return $this->morphTo();
	}

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}
}