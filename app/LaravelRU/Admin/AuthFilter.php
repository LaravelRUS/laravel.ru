<?php namespace LaravelRU\Admin;

use Illuminate\Auth\AuthManager;

class AuthFilter
{
	/**
	 * @var AuthManager
	 */
	private $auth;

	function __construct(AuthManager $auth)
	{
		$this->auth = $auth;
	}

	public function execute()
	{
		if ( ! $this->auth->check())
		{
			return redirect('login');
		}

		if ( ! $this->auth->user()->isAdmin())
		{
			return redirect('/');
		}

		return null;
	}
}
