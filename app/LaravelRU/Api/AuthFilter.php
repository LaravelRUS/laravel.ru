<?php namespace LaravelRU\Api;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Response;

class AuthFilter
{
	/**
	 * @var AuthManager
	 */
	private $auth;

	/**
	 * @var Response
	 */
	private $response;

	function __construct(AuthManager $auth, Response $response)
	{
		$this->auth = $auth;
		$this->response = $response;
	}

	public function execute()
	{
		if ( ! $this->auth->check() || ! $this->auth->user()->isAdmin())
		{
			return $this->response
				->setContent([
					'code' => Response::HTTP_UNAUTHORIZED,
				    'message' => 'Access denied'
				])
				->setStatusCode(Response::HTTP_UNAUTHORIZED);
		}

		return null;
	}
}
