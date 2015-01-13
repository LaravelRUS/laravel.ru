<?php

class Role extends \Eloquent {

	public      $timestamps =  false;

	public function users()
	{
		return $this->belongsToMany('User','user_role','role_id','user_id');
	}

}
