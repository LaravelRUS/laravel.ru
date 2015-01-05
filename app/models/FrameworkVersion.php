<?php
class FrameworkVersion extends Eloquent {

	protected   $table      =  'framework_versions';
	public      $timestamps =  false;

	public function posts()
	{
		return $this->hasMany("Post");
	}
}