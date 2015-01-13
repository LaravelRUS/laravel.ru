<?php
class Confirmation extends \Eloquent {

	public function user()
	{
		return $this->belongsTo("User");
	}
}