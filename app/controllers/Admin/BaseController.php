<?php namespace Admin;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelRU\Core\Http\ValidatesRequests;
use Vanchelo\AjaxResponse\Response;

class BaseController extends Controller
{
	use ValidatesRequests;

	/**
	 * @var string Model class name
	 */
	protected $modelClassName;

	/**
	 * @var Response
	 */
	protected $response;

	/**
	 * @var Request
	 */
	protected $request;

	/**
	 * @var Model
	 */
	protected $model;

	function __construct(Request $request, Response $response, AuthManager $auth)
	{
		$this->response = $response;
		$this->auth = $auth;
		$this->request = $request;
		$this->model = app($this->modelClassName);
	}

}
