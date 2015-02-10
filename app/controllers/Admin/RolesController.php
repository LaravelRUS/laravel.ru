<?php namespace Admin;

use Auth;

class RolesController extends BaseController
{
	protected $modelClassName = 'LaravelRU\User\Models\User';

	public function store()
	{
		$this->access->checkEditRoles();

		$user_id = $this->request->input('user_id');
		$role_id = $this->request->input('role_id');

		$user = $this->model->findOrFail($user_id);

		$arrayRoles = $user->roles()->lists('id');
		$arrayRoles[] = $role_id;
		$arrayRoles = array_unique($arrayRoles);

		$user->roles()->sync($arrayRoles);

		return app('redirect')->back();
	}

	public function destroy()
	{
		$this->access->checkEditRoles();

		$user_id = $this->request->input('user_id');
		$role_id = $this->request->input('role_id');

		// Запрещено снимать себе админский статус
		// TODO переделать на $this->access->... в модуле Admin, который тоже надо сделать.
		if ( ! ($this->auth->user()->id == $user_id AND $role_id == 1))
		{
			$user = $this->model->findOrFail($user_id);

			$arrayRoles = $user->roles()->lists('id');
			$arrayRoles = array_diff($arrayRoles, [$role_id]);
			$arrayRoles = array_unique($arrayRoles);

			$user->roles()->sync($arrayRoles);
		}

		return app('redirect')->back();
	}

}
