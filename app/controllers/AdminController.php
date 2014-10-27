<?php

use LaravelRU\Access\Access;

class AdminController extends \BaseController {

	/**
	 * @var Access
	 */
	private $access;

	public function __construct(Access $access)
	{
		$this->access = $access;
	}

	public function listUsers()
	{
		$users = User::orderBy("id", "asc")->with("roles")->get();
		$roles = Role::all();

		return View::make("admin/list_users", compact("users", "roles"));
	}

	public function addRole()
	{
		$this->access->checkEditRoles();
		$user_id = Input::get("user_id");
		$role_id = Input::get("role_id");
		$user = User::findOrFail($user_id);
		$arrayRoles = $user->roles()->lists("id");
		$arrayRoles[] = $role_id;
		$arrayRoles = array_unique($arrayRoles);
		$user->roles()->sync($arrayRoles);
		return Redirect::back();
	}
	public function removeRole()
	{
		$this->access->checkEditRoles();
		$user_id = Input::get("user_id");
		$role_id = Input::get("role_id");
		$user = User::findOrFail($user_id);
		$arrayRoles = $user->roles()->lists("id");
		$arrayRoles = array_diff($arrayRoles , [$role_id]);
		$arrayRoles = array_unique($arrayRoles);
		$user->roles()->sync($arrayRoles);
		return Redirect::back();
	}
	
}