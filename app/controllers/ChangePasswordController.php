<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Http\Request;
use LaravelRU\Core\Http\ValidatesRequests;
use Vanchelo\AjaxResponse\Response;

class ChangePasswordController extends BaseController
{
	use ValidatesRequests;

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var UserInterface
	 */
	private $user;

	/**
	 * @var Response
	 */
	private $response;

	function __construct(UserInterface $user, Request $request, Response $response)
	{
		$this->user = $user;
		$this->request = $request;
		$this->response = $response;
	}

	public function getForm()
	{
		return view('user.change-password')->with('user', $this->user);
	}

	public function postForm()
	{
		$this->validate($this->request, [
			'password_old' => 'required|password_check',
		    'password_new' => 'required|min:6|confirmed',
		    'password_new_confirmation' => 'required'
		]);

		$this->user->update([
			'password' => $this->request->input('password_new')
		]);

		return $this->response
			->data([
				'redirect' => route('user.edit'),
			    'title' => 'Пароль успешно изменен'
			]);
	}
}
