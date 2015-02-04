<?php

use LaravelRU\Access\Access;
use LaravelRU\Access\Models\Role;
use LaravelRU\User\Models\User;

class AdminController extends BaseController {

	/**
	 * @var Access
	 */
	private $access;

	public function __construct(Access $access)
	{
		$this->access = $access;
	}

	public function usersList()
	{
		$users = User::orderBy('id', 'asc')->withRoles()->get();
		$roles = Role::all();

		return View::make('admin.users-list', compact('users', 'roles'));
	}

	public function addRole()
	{
		$this->access->checkEditRoles();

		$user_id = Input::get('user_id');
		$role_id = Input::get('role_id');

		$user = User::findOrFail($user_id);

		$arrayRoles = $user->roles()->lists('id');
		$arrayRoles[] = $role_id;
		$arrayRoles = array_unique($arrayRoles);

		$user->roles()->sync($arrayRoles);

		return Redirect::back();
	}

	public function removeRole()
	{
		$this->access->checkEditRoles();

		$user_id = Input::get('user_id');
		$role_id = Input::get('role_id');

		// Запрещено сниматьсебе админский статус
		// TODO переделать на $this->access->... в модуле Admin, который тоже надо сделать.
		if ( ! (Auth::user()->id == $user_id AND $role_id == 1))
		{
			$user = User::findOrFail($user_id);

			$arrayRoles = $user->roles()->lists('id');
			$arrayRoles = array_diff($arrayRoles, [$role_id]);
			$arrayRoles = array_unique($arrayRoles);

			$user->roles()->sync($arrayRoles);
		}

		return Redirect::back();
	}

}
