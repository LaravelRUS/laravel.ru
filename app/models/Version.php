<?php

use Illuminate\Database\Eloquent\Model;

class Version extends Model {

	public $timestamps = false;

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function documents()
	{
		return $this->hasMany('Document');
	}

	public function tips()
	{
		return $this->hasMany('Tip');
	}

}
