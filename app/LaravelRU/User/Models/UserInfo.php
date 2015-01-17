<?php namespace LaravelRU\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model {

	public $timestamps = false;

	protected $table = 'user_info';

	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function user()
	{
		return $this->belongsTo('LaravelRU\User\Models\User', 'user_id');
	}

}
