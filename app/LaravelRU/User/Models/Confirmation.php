<?php namespace LaravelRU\User\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model {

	public function user()
	{
		return $this->belongsTo('LaravelRU\User\Models\User');
	}

}
