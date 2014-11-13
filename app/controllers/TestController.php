<?php

use LaravelRU\Github\GithubRepo;

class TestController extends BaseController {

	public function __construct()
	{

	}

	public function index()
	{
		$user = User::find(1);
		var_dump($user->posts);
	}

	public function utf($string)
	{
		return $string;
	}

	public function pregmatch()
	{
		var_dump(preg_match("#^/test/(?P<utf>[а-я]+)$#su", "/test/слово"));
	}

	public function getCommitByFile()
	{
		$client = new \Github\Client();
		$commits = $client->api('repo')->commits()->all('laravel', 'docs', array('sha' => 'master', 'path' => 'eloquent.md'));
		dd($commits);

	}
		
	
	
}