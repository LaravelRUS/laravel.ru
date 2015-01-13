<?php
class Version extends Eloquent {

	public      $timestamps =  false;

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function documents()
	{
		return $this->hasMany('Document');
	}
	
	public  function tips()
	{
		return $this->hasMany('Tip');
	}
}