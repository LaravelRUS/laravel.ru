<?php

class FrameworkVersion extends Eloquent {

	public $timestamps = false;

	protected $table = 'framework_versions';

	/**
	 * Ralations
	 */

	public function posts()
	{
		return $this->hasMany('Post');
	}

}
