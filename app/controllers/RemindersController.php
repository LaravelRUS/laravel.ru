<?php

use Illuminate\Auth\Reminders\PasswordBroker;
use Illuminate\Http\Request;
use LaravelRU\Core\Http\ValidatesRequests;
use Vanchelo\AjaxResponse\Response;

class RemindersController extends BaseController
{
	use ValidatesRequests;

	/**
	 * @var Response
	 */
	private $response;

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var PasswordBroker
	 */
	private $passwordBroker;

	function __construct(Request $request, Response $response, PasswordBroker $passwordBroker)
	{
		$this->request = $request;
		$this->response = $response;
		$this->passwordBroker = $passwordBroker;
	}

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$this->validate($this->request, [
			'email' => 'required|email'
		]);

		$response = $this->passwordBroker->remind($this->request->only('email'));

		if ($response == PasswordBroker::INVALID_USER)
		{
			$this->response->errors(['email' => [trans($response)]]);
		}

		return $this->response->message(trans($response));
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) abort();

		return view('password.reset', compact('token'));
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$this->validate($this->request, [
			'email' => 'required|email',
		    'password' => 'required|min:6|confirmed',
		    'password_confirmation' => 'required',
		    'token' => 'required'
		]);

		$credentials = $this->request->only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = $this->passwordBroker->reset($credentials, function($user, $password)
		{
			$user->update([
				'password' => $user->getAuthPassword()
			]);
		});

		switch ($response)
		{
			case PasswordBroker::INVALID_PASSWORD:
			case PasswordBroker::INVALID_TOKEN:
			case PasswordBroker::INVALID_USER:
				return redirect()->back()->with('error', Lang::get($response));

			case PasswordBroker::PASSWORD_RESET:
				return redirect()->to('/');
		}
	}

}
