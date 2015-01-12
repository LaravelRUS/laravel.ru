<?php

class UserConfirmation extends \Eloquent {

	protected $table = 'users_confirmation';
	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function user()
	{
		return $this->belongsTo('User');
	}
}
