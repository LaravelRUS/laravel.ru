<?php

use LaravelRU\Github\GithubRepo;

class TestController extends BaseController {

	public function __construct()
	{

	}

	public function index()
	{
		$user = User::find(1);
		var_dump($user->roles->toArray());
		return "debug";
	}

	public function getCommitByFile()
	{
		$client = new \Github\Client();
		$commits = $client->api('repo')->commits()->all('laravel', 'docs', array('sha' => '4.1', 'path' => 'html.md'));
		dd($commits);

	}
		
	
	
}