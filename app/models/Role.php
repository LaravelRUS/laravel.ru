<?php

class Role extends Eloquent {


	protected   $table = 'roles';

	public      $timestamps =  false;

	public function users()
	{
		return $this->belongsToMany("User","user_role","role_id","user_id");
	}

}
