<?php
use Illuminate\Database\Eloquent\Model;

class Likes  extends Model{

	protected $table = 'likes';

	public function likeable()
	{
		return $this->morphTo();
	}

}