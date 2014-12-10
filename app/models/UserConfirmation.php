<?php
class UserConfirmation extends \Eloquent {

	protected   $table =       'users_confirmation';
	protected   $primaryKey =  'id';
	public      $timestamps =  true;

	protected   $guarded =     [];
	protected   $hidden =      [];

	public function user()
	{
		return $this->belongsTo("User");
	}
	
	
}