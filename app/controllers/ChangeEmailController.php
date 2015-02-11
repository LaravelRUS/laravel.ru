<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Http\Request;
use LaravelRU\Core\Http\ValidatesRequests;
use Vanchelo\AjaxResponse\Response;

class ChangeEmailController extends BaseController
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
		return view('user.change-email')->with('user', $this->user);
	}

	public function postForm()
	{
		$this->validate($this->request, [
			'email' => 'required|email|unique:users',
		]);

		return $this->response
			->data([
				'redirect' => route('user.edit'),
				'title' => 'Вам выслано письмо для подтверждения Email'
			]);
	}
}
