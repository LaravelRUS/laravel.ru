<?php

use Illuminate\Database\Eloquent\Model;

class Version extends Model {

	const MASTER = 'master';

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

	public function isMaster()
	{
		return (bool) $this->is_master;
	}

	public function isDefault()
	{
		return (bool) $this->is_default;
	}

	function __toString()
	{
		return $this->iteration;
	}

}
