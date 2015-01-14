<?php

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	public function likeable()
	{
		return $this->morphTo();
	}

}