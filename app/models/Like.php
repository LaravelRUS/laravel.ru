<?php

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	protected $table = 'likes';

	public function likeable()
	{
		return $this->morphTo();
	}

}