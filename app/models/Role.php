<?php
class Role extends Eloquent {

	protected   $table =       'user_roles';
	protected   $primaryKey =  'id';
	public      $timestamps =  false;
	protected   $softDelete =  false;
	protected   $guarded =     [];
	protected   $hidden =      [];
	
	public function users()
	{
		return $this->belongsToMany("User","user_role_pivot","role_id","user_id");
	}

}