<?php namespace LaravelRU\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialNetwork extends Model {

	public $timestamps = false;

	protected $table = 'user_social_network';

	protected $guarded = [];

	/**
	 * Ralations
	 */

	public function user()
	{
		return $this->belongsTo('LaravelRU\User\Models\User', 'user_id');
	}

}
