<?php namespace Api;

use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Controller;
use Vanchelo\AjaxResponse\Response;

class BaseController extends Controller
{
	protected $modelClassName;
	protected $response;

	function __construct(Response $response, AuthManager $auth)
	{
		$this->response = $response;
		$this->auth = $auth;
		$this->model = app($this->modelClassName);
	}
}
