<?php namespace LaravelRU\User\Repositories;

use Closure;
use LaravelRU\Core\Repository\AbstractRepository;
use LaravelRU\User\Models\User;

class UserRepo extends AbstractRepository {

	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function all()
	{
		return $this->model->withInfo()->get();
	}

	public function search($query, Closure $callback = null)
	{
		$q = $this->model->query();
		$q->with('info');
		$q->search($query);

		if ( ! is_null($callback)) call_user_func($callback, $q);

		return $q->paginate(10);
	}

	public function searchWithStatus($query, $status)
	{
		return $this->search($query, function ($q) use ($status)
		{
			// $status - online() or offline()
			$status && $q->{$status}();
		});
	}

	public function searchWithGroup($query, $group)
	{
		return $this->search($query, function ($q) use ($group)
		{
			$q->whereHas('roles', function ($query) use ($group)
			{
				$query->where('name', str_singular($group));
			});
		});
	}

}
