<?php namespace LaravelRU\Access\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	public $timestamps = false;

	protected $table = 'roles';

	public function users()
	{
		return $this->belongsToMany('LaravelRU\User\Models\User', 'user_role', 'role_id', 'user_id');
	}

}
