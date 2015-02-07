<?php namespace Admin;

use LaravelRU\Access\Models\Role;
use View;

class UsersController extends BaseController
{
	protected $modelClassName = 'LaravelRU\User\Models\User';

	public function index()
	{
		$users = $this->model->orderBy('id', 'asc')->withRoles()->get();

		if ( ! $this->request->ajax())
		{
			$roles = Role::all();

			return View::make('admin.users.index', compact('users', 'roles'));
		}

		return $this->response->data([
			'data' => $users,
			'total' => $this->model->count(),
		]);
	}

	public function show($id)
	{
		return View::make('admin.users.show')
			->with('user', $this->model->findOrFail($id));
	}

	public function edit($id)
	{
		return View::make('admin.restricted-words.edit')
			->with('word', $this->model->findOrFail($id));
	}

	public function create()
	{
		return View::make('admin.users.create');
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

	public function store()
	{

	}

	public function update($id)
	{

	}
}
