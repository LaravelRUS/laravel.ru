<?php namespace LaravelRU\User\Repositories;

use LaravelRU\Core\Repository\AbstractRepository;
use LaravelRU\User\Models\User;

class UserRepo extends AbstractRepository {

	public function __construct(User $user)
	{
		$this->model = $user;
	}

}