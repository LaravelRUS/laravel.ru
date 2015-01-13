<?php

class Role extends Eloquent {

<<<<<<< HEAD
	protected   $table =       'roles';

	public      $timestamps =  false;

	public function users()
	{
		return $this->belongsToMany("User","user_role","role_id","user_id");
=======
	public $timestamps = false;

	protected $table = 'user_roles';
	protected $softDelete = false;
	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function users()
	{
		return $this->belongsToMany('User', 'user_role_pivot', 'role_id', 'user_id');
>>>>>>> 54f09da6ce9ac5009c314d8debc50ebbcac69208
	}

}
