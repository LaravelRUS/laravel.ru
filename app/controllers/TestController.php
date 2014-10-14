<?php

use LaravelRU\Github\GithubRepo;

class TestController extends BaseController {

	public function __construct()
	{

	}

	public function index()
	{
		$githubClient = new GithubRepo(\Config::get("laravel.original_docs.user"),   \Config::get("laravel.original_docs.repository"));
		$commit = $githubClient->getLastCommit("master", "documentation.md");
		$date = $commit['commit']['committer']['date'];
		$carbon = \Carbon\Carbon::createFromTimestampUTC(strtotime($date));
		dd($carbon);
	}

	public function getCommitByFile()
	{
		$client = new \Github\Client();
		$commits = $client->api('repo')->commits()->all('laravel', 'docs', array('sha' => '4.1', 'path' => 'html.md'));
		dd($commits);
	}
		
	
	
}