<?php namespace Api;

class UsersController extends BaseController
{
	protected $modelClassName = 'LaravelRU\User\Models\User';

	public function index()
	{
		return $this->response->data([
			'data' => $this->model->withRoles()->get(),
			'total' => $this->model->count(),
		]);
	}

	public function show($id)
	{
		return $this->response->data([
			'data' => $this->model->withRoles()->find($id),
		]);
	}

	public function remove($id)
	{
		if ($this->auth->user()->id == $id)
		{
			return $this->response->error('You cannot delete youself');
		}

		$user = $this->model->findOrFail($id);

		if ($user->isAdmin)
		{
			return $this->response->error('You cannot delete administrator');
		}

		if ( ! $user->delete())
		{
			return $this->response->error("Something went wrong when deleting user with ID {$id}");
		}

		return $this->response->message('User successfully deleted');
	}

	public function store($id)
	{

	}
}
