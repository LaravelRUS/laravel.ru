<?php

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model {

	public function user()
	{
		return $this->belongsTo('User');
	}

}
