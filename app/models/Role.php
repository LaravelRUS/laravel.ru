<?php

class Role extends Eloquent {

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
	}

}
