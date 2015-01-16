<?php namespace LaravelRU\User\Repositories;

use LaravelRU\Core\Repository\BaseRepository;
use LaravelRU\User\Models\User;

class UserRepo extends BaseRepository {

	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function getByName($name)
	{
		return $this->model->where('name', $name)->first();
	}

}