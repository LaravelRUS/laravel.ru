<?php

use Illuminate\Http\Request;
use LaravelRU\Core\Http\ValidatesRequests;
use LaravelRU\User\Repositories\UserRepo;

class UsersController extends BaseController
{
	use ValidatesRequests;

	/**
	 * @var UserRepo
	 */
	private $users;

	/**
	 * @var Request
	 */
	private $request;

	function __construct(UserRepo $users, Request $request)
	{
		$this->users = $users;
		$this->request = $request;
	}

	public function index($status = null)
	{
		$users = $this->users->searchWithStatus(
			$query = $this->request->input('query'),
			$status
		);

		return view('users.index', compact('users', 'query'));
	}

	public function group($group)
	{
		$users = $this->users->searchWithGroup(
			$query = $this->request->input('query'),
			$group
		);

		return view('users.index', compact('users', 'query'));
	}

}
