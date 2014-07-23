<?php namespace SU\User\Models;

use SU\Core\Repository\BaseRepository;

class UserRepo extends BaseRepository{

	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function getByName($name)
	{
		return $this->model->where("name", $name)->first();
	}

} 